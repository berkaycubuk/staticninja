<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Forms/Account');
    }

    public function accountSettingsView()
    {
        return Inertia::render('AccountSettings', [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ]);
    }

    public function settingsView()
    {
        return Inertia::render('Forms/AccountSettings', [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ]);
    }

    public function passwordChange(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user = User::where('id', auth()->user()->id)->first();
        if (!$user) {
            return back()->withErrors([
                'password' => 'User not found.',
            ]);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect('/forms/home');
    }
}
