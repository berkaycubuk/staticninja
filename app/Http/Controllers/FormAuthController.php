<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Password;

class FormAuthController extends Controller
{
    public function loginView(Request $request)
    {
        return Inertia::render('Forms/Login', [
            'status' => $request->session()->get('status'),
        ]);
    }

    public function loginPost(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:80',
            'password' => 'required|max:50',
        ]);

        if (Auth::attempt($validated, true)) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Wrong email or password.',
        ])->onlyInput('email');
    }

    public function registerView()
    {
        return Inertia::render('Forms/Register');
    }

    public function registerPost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:80',
            'email' => 'required|min:3|max:80|unique:users',
            'password' => 'required|min:3|max:80|confirmed',
        ]);

        // register the user
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['email']);
        $user->save();

        Auth::login($user);

        return redirect('/forms/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/forms');
    }

    public function verifyView(Request $request)
    {
        if ($request->session()->get('message')) {
            return Inertia::render('Forms/VerifyEmail', [
                'message' => $request->session()->get('message'),
            ]);
        }

        return Inertia::render('Forms/VerifyEmail');
    }

    public function resendEmailValidation(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Email sent!');
    }

    public function passwordRequest(Request $request)
    {
        return Inertia::render('Forms/PasswordResetRequest', [
            'status' => $request->session()->get('status'),
        ]);
    }

    public function passwordEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|min:3|max:80',
        ]);

        $status = Password::sendResetLink(
            [
                'email' => $validated['email'],
            ]
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function passwordReset(Request $request, $token)
    {
        return Inertia::render('Forms/PasswordReset', [
            'token' => $token,
        ]);
    }

    public function passwordResetSubmit(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|max:80',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect('/forms/login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
