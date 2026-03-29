<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Crop;
use App\Models\Disease;
use App\Models\Consultation;
use App\Models\SuccessStory;
use App\Mail\ExpertApprovedMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['farmer', 'expert'])->get();
        $crops = Crop::all();
        $diseases = Disease::with('crop')->latest()->get();
        $consultations = Consultation::with(['farmer','expert'])
        ->orderBy('date','desc')
        ->orderBy('time','desc')
        ->get();

        // $stories = SuccessStory::with('user')
        // ->orderBy('created_at','desc')
        // ->get();

        $stories = SuccessStory::with('user')
        ->orderBy('created_at','desc')
        ->paginate(10);

        // $totalUsers    = User::count();
        $totalUsers = User::whereIn('role', ['farmer','expert'])->count();
        $storiesCount  = SuccessStory::count();
        $consultationsCount = Consultation::count();

        return view('admin.dashboard', compact('users','crops','diseases','consultations','stories',
        'totalUsers','storiesCount','consultationsCount'));

    }

    // public function approveExpert($id)
    // {
    //     $expert = User::findOrFail($id);
    //     $expert->is_approved = true;
    //     $expert->save();

    //     return redirect()->route('admin.dashboard', ['section' => 'users'])
    //     ->with('success', 'Expert approved successfully');
    // }

    public function approveExpert($id)
    {
        $expert = User::findOrFail($id);
        $expert->is_approved = true;
        $expert->save();

        // Send email
        Mail::to($expert->email)->send(new ExpertApprovedMail($expert));

        return redirect()->route('admin.dashboard', ['section' => 'users'])
            ->with('success', 'Expert approved successfully and email sent.');
    }


    public function rejectExpert($id)
    {
        $expert = User::findOrFail($id);
        $expert->delete();

        return redirect()->route('admin.dashboard', ['section' => 'users'])
            ->with('success', 'Expert rejected successfully');
    }

    public function Userdestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard', ['section' => 'users'])
        ->with('success', 'User deleted successfully');
    }


}

