<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class DeicController extends Controller
{
    public function loginForm()
    {
        return view('deic.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'pediatrician') {
                return redirect()->intended('pediatrician/dashboard');
            }
            return redirect()->intended('deic/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        $district = Auth::user()->district;
        $registrations = Registration::where('district', $district)->get();
        return view('deic.dashboard', compact('registrations'));
    }

    public function showProfile($id)
    {
        $registration = Registration::with('diagnoses.diagnosisType', 'diagnoses.diagnosis', 'diagnoses.category')
            ->findOrFail($id);
        
        if ($registration->district !== Auth::user()->district) {
            abort(403);
        }

        return view('deic.profile', compact('registration'));
    }

    public function verify($id)
    {
        $registration = Registration::findOrFail($id);
        
        if ($registration->district !== Auth::user()->district || $registration->current_step < 7) {
            abort(403);
        }

        $registration->update([
            'case_id' => 'NHM-HR-2026-' . str_pad($registration->id, 5, '0', STR_PAD_LEFT),
            'status' => 'Forwarded to Pediatrician'
        ]);

        return redirect()->back()->with('success', 'Case verified and forwarded to district pediatrician.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/deic/login');
    }
}
