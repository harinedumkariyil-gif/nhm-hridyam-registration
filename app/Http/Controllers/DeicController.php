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
        
        // Ensure user can only see their district's patients
        if ($registration->district !== Auth::user()->district) {
            abort(403);
        }

        return view('deic.profile', compact('registration'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/deic/login');
    }
}
