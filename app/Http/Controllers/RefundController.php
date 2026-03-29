<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use App\Models\Consultation;
// use App\Models\Refund;

// class RefundController extends Controller
// {
//     public function requestRefund($id)
//     {
//         $consultation = Consultation::findOrFail($id);

//         if ($consultation->status === 'cancelled' && $consultation->payment_status === 'paid') {
//             Refund::create([
//                 'booking_id' => $consultation->id,
//                 'user_id'    => Auth::id(),
//                 'amount' => $consultation->expert->expertProfile->consultation_fee,
//                 'status' => 'pending',
//                 'reason' => 'Consultation cancelled',
//             ]);

//             return redirect()->back()->with('success', 'Refund request submitted successfully.');
//         }

//         return redirect()->back()->with('error', 'Refund not eligible.');
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Consultation;
use App\Models\Refund;

class RefundController extends Controller
{
    // public function requestRefund($id)
    // {
    //     $consultation = Consultation::findOrFail($id);

    //     if ($consultation->status === 'cancelled' && $consultation->payment_status === 'paid') {
    //         Refund::create([
    //             'booking_id' => $consultation->id,
    //             'user_id'    => Auth::id(),
    //             'amount'     => $consultation->expert->expertProfile->consultation_fee,
    //             'status'     => 'approved', // auto‑approve immediately
    //             'reason'     => 'Consultation cancelled',
    //         ]);

    //         // Redirect with fragment to stay in My Consultations section
    //     return redirect()->to(
    //         route('farmer.dashboard') . '#my-consultations'
    //     )->with('success', 'Refund approved successfully.');
    // }

    // // Error case also stays in same section
    //     return redirect()->to(
    //         route('farmer.dashboard') . '#my-consultations'
    //     )->with('error', 'Refund not eligible.');

    // }

    public function requestRefund(Request $request, $id)
{
    $consultation = Consultation::findOrFail($id);

    if ($consultation->status === 'cancelled' && $consultation->payment_status === 'paid') {
        Refund::create([
            'booking_id' => $consultation->id,
            'user_id'    => Auth::id(),
            'amount'     => $consultation->expert->expertProfile->consultation_fee,
            'status'     => 'approved', // auto‑approve immediately
            'reason'     => $request->input('reason') ?? 'No reason provided',
        ]);

        return redirect()->to(
            route('farmer.dashboard') . '#my-consultations'
        )->with('success', 'Refund approved successfully!');
    }

    return redirect()->to(
        route('farmer.dashboard') . '#my-consultations'
    )->with('error', 'Refund not eligible.');
}
}
