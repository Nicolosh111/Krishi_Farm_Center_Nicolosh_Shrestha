<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\FarmerProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
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
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(Request $request): RedirectResponse
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|confirmed|min:8',

        'location' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'experience' => 'nullable|integer|min:0',
        'bio' => 'nullable|string',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    $profile = FarmerProfile::firstOrCreate(
        ['user_id' => $user->id]
    );

    if ($request->hasFile('profile_image')) {
        $imagePath = $request->file('profile_image')->store('profiles', 'public');
        $profile->profile_image = $imagePath;
    }

    $profile->update([
        'location' => $request->location,
        'phone' => $request->phone,
        'experience' => $request->experience,
        'bio' => $request->bio,
    ]);

   return redirect()->route('farmer.dashboard', ['section' => 'profile'])
    ->with('success', 'Profile updated successfully');
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

    public function setLocation(Request $request)
    {
        $lat = $request->lat;
        $lon = $request->lon;

        $apiKey = env('LOCATIONIQ_KEY');
        $url = "https://us1.locationiq.com/v1/reverse.php?key={$apiKey}&lat={$lat}&lon={$lon}&format=json";

        $geo = Http::get($url)->json();
        $address = $geo['address'] ?? [];

        // Try city, then town, then village
        $cityOrTown = $address['city']
            ?? $address['town']
            ?? $address['village']
            ?? null;

        // District/county fallback
        $district = $address['county']
            ?? $address['state_district']
            ?? null;

        $locationName = implode(', ', array_filter([$cityOrTown, $district]));

        return response()->json(['locationName' => $locationName]);
    }
}
