<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    //
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    $request->user()->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password updated successfully!');
}

    public function updateProfile(Request $request)
{
    $request->validate([
        'profile_picture' => 'image|mimes:jpeg,png,jpg|max:2048', // Hanggang 2MB lang
    ]);

    $user = $request->user();

    if ($request->hasFile('profile_picture')) {
        // I-save ang file sa 'public/profile_pictures' folder
        $fileName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->move(public_path('profile_pictures'), $fileName);
        
        $user->profile_picture = $fileName;
        $user->save();
    }

    return back()->with('success', 'Profile picture updated!');
}
}
