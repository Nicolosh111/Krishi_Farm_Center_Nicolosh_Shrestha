<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */

        $user = Auth::user();

        // Validate input
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email,' . $user->id,
        //     'password' => 'required|confirmed|min:8',
        // ]);

        // Custom validator so we can control redirect
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
    return redirect()->back()
        ->withErrors($validator)
        ->withInput()
        ->withFragment('profile'); // stays in profile tab
}


        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // dd($user);
        $user->save();

        // return redirect()->back()->with('success', 'Profile updated successfully!');
     return redirect()
    ->route('admin.dashboard', ['section' => 'profile'])
    ->with('success', 'Profile updated successfully');
    }

}
