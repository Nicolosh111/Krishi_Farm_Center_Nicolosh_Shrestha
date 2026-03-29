<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try{
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->intended(route('home', absolute: false));

         $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'expert') {
        if (! $user->is_approved) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Your account is pending admin approval.');
        }

        return redirect()->route('expert.dashboard');
    }

    return redirect()->route('home');

      } catch (ValidationException $e) {
        return back()->with('error', 'The provided credentials do not match our records.');
    }

}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function farmerLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return redirect('/home');

         return redirect()->route('home');
    }
}
