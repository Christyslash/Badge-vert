<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    if (! Hash::check($request->current_password, $request->user()->password)) {
        return back()->withErrors([
            'current_password' => 'Le mot de passe actuel est incorrect.',
        ]);
    }

    $request->user()->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('status', 'password-updated');
}

public function editUserPassword(User $user)
{
    return view('users.password', compact('user'));
}

public function updateUserPassword(Request $request, User $user)
{
    $request->validate([
        'password' => ['required', 'confirmed', Password::min(8)],
    ]);

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Mot de passe réinitialisé avec succès.');
}



}
