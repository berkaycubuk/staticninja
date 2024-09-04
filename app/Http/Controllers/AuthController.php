<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function loginView(Request $request)
    {
        return Inertia::render('Login', [
            'lang' => [
                'login_to_static_ninja' => __('auth.login_to_static_ninja'),
                'email' => __('auth.email'),
                'password' => __('auth.password'),
                'login' => __('auth.login'),
                'forgot_password' => __('auth.forgot_password'),
                'login_with_google' => __('auth.login_with_google'),
                'dont_have_an_account' => __('auth.dont_have_an_account'),
            ],
            'signup_route' => route('signup.view'),
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

    public function signupView(Request $request)
    {
        return Inertia::render('Signup', [
            'lang' => [
                'sign_up_to_static_ninja' => __('auth.sign_up_to_static_ninja'),
                'name' => __('auth.name'),
                'email' => __('auth.email'),
                'password' => __('auth.password'),
                'password_confirmation' => __('auth.password_confirmation'),
                'sign_up' => __('auth.sign_up'),
                'already_have_an_account' => __('auth.already_have_an_account'),
                'sign_up_with_google' => __('auth.sign_up_with_google'),
            ],
            'login_route' => route('login.view'),
        ]);
    }

    public function signupPost(Request $request)
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

        return redirect('/redirect');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
