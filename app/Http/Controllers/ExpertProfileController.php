<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\ExpertProfile;
use App\Models\User;
use App\Models\Consultation;

class ExpertProfileController extends Controller
{
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validate input
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'password'         => 'nullable|confirmed|min:8',

            'phone'            => 'nullable|string|max:20',
            'specialization'   => 'nullable|string|max:255',
            'qualification'    => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'bio'              => 'nullable|string',
            'profile_image'    => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        // Update user basic info
        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update or create expert profile
        $profile = ExpertProfile::firstOrCreate(['user_id' => $user->id]);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profiles', 'public');
            $profile->profile_image = $imagePath;
        }

        $profile->update([
            'phone'            => $request->phone,
            'specialization'   => $request->specialization,
            'qualification'    => $request->qualification,
            'experience_years' => $request->experience_years,
            'consultation_fee' => $request->consultation_fee,
            'bio'              => $request->bio,
        ]);

        return redirect()->route('expert.dashboard', ['section' => 'profile'])
            ->with('success', 'Profile updated successfully');
    }

    // public function index(Request $request)
    // {
    //     $query = User::whereHas('expertProfile')->with('expertProfile');

    //     // Filters
    //     if ($request->filled('specialization')) {
    //         $query->whereHas('expertProfile', function ($q) use ($request) {
    //             $q->where('specialization', 'like', '%' . $request->specialization . '%');
    //         });
    //     }

    //     if ($request->filled('min_fee')) {
    //         $query->whereHas('expertProfile', function ($q) use ($request) {
    //             $q->where('consultation_fee', '>=', $request->min_fee);
    //         });
    //     }

    //     if ($request->filled('max_fee')) {
    //         $query->whereHas('expertProfile', function ($q) use ($request) {
    //             $q->where('consultation_fee', '<=', $request->max_fee);
    //         });
    //     }

    //     if ($request->filled('experience_years')) {
    //         $query->whereHas('expertProfile', function ($q) use ($request) {
    //             $q->where('experience_years', '>=', $request->experience_years);
    //         });
    //     }

    //     $experts = $query->paginate(9); // paginated list
    //     return view('experts.index', compact('experts'));
    // }


    // public function index(Request $request)
    // {
    //     $query = User::whereHas('expertProfile')->with('expertProfile');

    //     if ($request->filled('specialization')) {
    //         $query->whereHas('expertProfile', fn($q) =>
    //             $q->where('specialization', 'like', '%' . $request->specialization . '%')
    //         );
    //     }
    //     if ($request->filled('min_fee')) {
    //         $query->whereHas('expertProfile', fn($q) =>
    //             $q->where('consultation_fee', '>=', $request->min_fee)
    //         );
    //     }
    //     if ($request->filled('max_fee')) {
    //         $query->whereHas('expertProfile', fn($q) =>
    //             $q->where('consultation_fee', '<=', $request->max_fee)
    //         );
    //     }
    //     if ($request->filled('experience_years')) {
    //         $query->whereHas('expertProfile', fn($q) =>
    //             $q->where('experience_years', '>=', $request->experience_years)
    //         );
    //     }

    //     $experts = $query->paginate(9);

    //     // Always return partial for AJAX
    //     return view('partials.expert-results', compact('experts'))->render();
    // }


public function index(Request $request)
{
    $query = User::whereHas('expertProfile')->with('expertProfile');

    if ($request->filled('specialization')) {
        $query->whereHas('expertProfile', fn($q) =>
            $q->where('specialization', 'like', '%' . $request->specialization . '%')
        );
    }
    if ($request->filled('min_fee')) {
        $query->whereHas('expertProfile', fn($q) =>
            $q->where('consultation_fee', '>=', $request->min_fee)
        );
    }
    if ($request->filled('max_fee')) {
        $query->whereHas('expertProfile', fn($q) =>
            $q->where('consultation_fee', '<=', $request->max_fee)
        );
    }
    if ($request->filled('experience_years')) {
        $query->whereHas('expertProfile', fn($q) =>
            $q->where('experience_years', '>=', $request->experience_years)
        );
    }

    $experts = $query->paginate(9);

    // Add booked expert IDs for the logged-in farmer
    // $bookedExpertIds = Consultation::where('farmer_id', Auth::id())
    //                                ->pluck('expert_id')
    //                                ->toArray();

    $bookedExpertIds = Consultation::where('farmer_id', Auth::id())
    ->where('payment_status', 'paid')
    ->pluck('expert_id')
    ->toArray();

    // Return partial view for AJAX
    return view('partials.expert-results', compact('experts', 'bookedExpertIds'))->render();
}

     public function show($id)
    {
        $expert = User::with('expertProfile')->findOrFail($id);
        return view('expert.show', compact('expert'));
    }

}
