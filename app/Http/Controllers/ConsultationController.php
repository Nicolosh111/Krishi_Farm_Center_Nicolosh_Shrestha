<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function create(User $expert)
    {
        // Show booking form with expert info
        return view('consultations.create', compact('expert'));
    }

    public function store(Request $request, User $expert)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'nullable|string',
        ]);

        Consultation::create([
            'expert_id' => $expert->id,
            'farmer_id' => Auth::id(),
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
        ]);

        // Redirect back to expert profile with success message
        // return redirect()->route('expert.show', $expert->id)
        //                  ->with('success', 'Consultation booked successfully');

        return redirect()->to(route('farmer.dashboard') . '#experts')
                    ->with('success', 'Consultation booked successfully.');
    }

    public function cancel($id)
    {
        $consultation = Consultation::where('id', $id)
            ->where('farmer_id', Auth::id())
            ->firstOrFail();

        $consultation->status = 'cancelled';
        $consultation->save();

        return redirect()->to(route('farmer.dashboard') . '#my-consultations')
                        ->with('success', 'Consultation cancelled successfully.');
    }
}


