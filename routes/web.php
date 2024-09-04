<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\FormAuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewSiteController;
use App\Http\Middleware\SetLocale;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::prefix('{locale?}')
    ->middleware(SetLocale::class)
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->group(function() {

    // Auth
    Route::get('/login', [AuthController::class, 'loginView'])
        ->name('login.view')
        ->middleware(['guest']);
    Route::post('/login', [AuthController::class, 'loginPost'])
        ->name('login.post')
        ->middleware(['guest']);
    Route::get('/signup', [AuthController::class, 'signupView'])
        ->name('signup.view')
        ->middleware(['guest']);
    Route::post('/signup', [AuthController::class, 'signupPost'])
        ->name('signup.post')
        ->middleware(['guest']);

    // Dashboard
    Route::prefix('dashboard')
        ->middleware(['auth', 'verified'])
        ->group(function() {
            Route::get('/', [DashboardController::class, 'index'])
                ->name('home');

            Route::get('/new-site', [NewSiteController::class, 'index']);
            Route::post('/new-site', [NewSiteController::class, 'store']);
            Route::delete('/delete-site/{id}', [DashboardController::class, 'deleteSite']);

            // Designer
            Route::get('/site/{id}/designer', [DesignerController::class, 'index']);
            Route::post('/site/{id}/designer', [DesignerController::class, 'saveSite']);

            Route::post('/site/{id}/upload-image', [DesignerController::class, 'uploadImage']);

            Route::get('/site/{id}/tools', [DashboardController::class, 'tools']);

            Route::get('/site/{id}/settings', [DashboardController::class, 'settings']);
            Route::post('/site/{id}/settings', [DashboardController::class, 'settingsStore']);

            Route::get('/account', [DashboardController::class, 'account']);
            Route::get('/account/settings', [AccountController::class, 'accountSettingsView']);

            Route::get('/logout', [AuthController::class, 'logout']);
        });


    // TODO: Old auth stuff, should be converted to new version
    Route::get('/verify-email', [FormAuthController::class, 'verifyView'])
        ->middleware('auth')
        ->name('verification.notice');
    Route::post('/resend-email-validation', [FormAuthController::class, 'resendEmailValidation'])
        ->name('verification.verify')
        ->middleware(['auth', 'throttle:6,1']);
    Route::get('/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/dashboard');
    })
        ->name('verification.verify')
        ->middleware(['auth', 'signed']);

    /* Forms Panel */
    Route::get('/forms/reset-password', [FormAuthController::class, 'passwordRequest'])
        ->middleware('guest')
        ->name('password.request');
    Route::get('/forms/reset-password/{token}', [FormAuthController::class, 'passwordReset'])
        ->middleware('guest')
        ->name('password.reset');
    Route::post('/forms/reset-password-submit', [FormAuthController::class, 'passwordResetSubmit'])
        ->middleware('guest')
        ->name('password.update');
    Route::post('/forms/reset-password', [FormAuthController::class, 'passwordEmail'])
        ->middleware('guest')
        ->name('password.email');

    Route::get('/auth/google/redirect', function() {
        return Socialite::driver('google')->redirect();
    });

    Route::get('/auth/google/callback', function() {
        error_log('callback hit');
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make(rand(100000,999999)),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    });
});
