<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Consultation;

class PaymentController extends Controller
{
    /**
     * Initiate Khalti payment (KPG-2 redirect flow)
     */
    public function initiatePayment(Request $request, $expertId)
    {
        // Create Consultation in "pending" state
        $consultation = Consultation::create([
            'farmer_id' => Auth::id(),
            'expert_id' => $expertId,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // Call Khalti initiate API
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . config('services.khalti.secret_key')
        ])->post('https://a.khalti.com/api/v2/epayment/initiate/', [
            'return_url' => route('payment.callback'),
            'website_url' => config('app.url'),
            'amount' => intval($request->fee) * 100, // Rs × 100 = paisa
            'purchase_order_id' => $consultation->id,
            'purchase_order_name' => 'Consultation with Expert',
            'customer_info' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => '9800000000', // sandbox test number
            ],
        ]);

        $data = $response->json();

        // Save pidx temporarily in consultation
        if (isset($data['pidx'])) {
            $consultation->update([
                'transaction_id' => $data['pidx'],
            ]);
        }

        if (isset($data['payment_url'])) {
            return redirect()->away($data['payment_url']);
        }

        return back()->withErrors(['error' => 'Payment initiation failed']);
    }

    public function callback(Request $request)
{
    $pidx = $request->pidx;

    $response = Http::withHeaders([
        'Authorization' => 'Key ' . config('services.khalti.secret_key')
    ])->post('https://a.khalti.com/api/v2/epayment/lookup/', [
        'pidx' => $pidx,
    ]);

    $data = $response->json();

    // Find consultation by pidx (stored earlier in transaction_id)
    $consultation = Consultation::where('transaction_id', $pidx)->first();

    if (isset($data['status']) && $data['status'] === 'Completed' && $consultation) {
        $consultation->update([
            'status' => 'upcoming',
            'payment_status' => 'paid',
            'transaction_id' => $data['transaction_id'] ?? $consultation->transaction_id,
        ]);

       return redirect()->route('farmer.dashboard', ['section' => 'experts'])
    ->with('success', 'Payment successful! Consultation booked.');
    }

    if ($consultation) {
        $consultation->update(['status' => 'failed']);
    }

    return redirect()->route('farmer.dashboard')
        ->withErrors(['error' => 'Payment verification failed']);
}
}
