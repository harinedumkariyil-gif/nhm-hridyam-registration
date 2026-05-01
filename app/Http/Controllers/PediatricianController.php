<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class PediatricianController extends Controller
{
    public function dashboard()
    {
        $district = Auth::user()->district;
        // Only show cases that are forwarded or already evaluated
        $registrations = Registration::where('district', $district)
            ->whereIn('status', ['Forwarded to Pediatrician', 'Expert Opinion Requested', 'Expert Opinion Not Required'])
            ->get();
            
        return view('pediatrician.dashboard', compact('registrations'));
    }

    public function showCase($id)
    {
        $registration = Registration::with('diagnoses.diagnosisType', 'diagnoses.diagnosis', 'diagnoses.category')
            ->findOrFail($id);
        
        if ($registration->district !== Auth::user()->district) {
            abort(403);
        }

        return view('pediatrician.case', compact('registration'));
    }

    public function markOpinion(Request $request, $id)
    {
        $request->validate([
            'opinion' => 'required|in:1,0'
        ]);

        $registration = Registration::findOrFail($id);
        
        if ($registration->district !== Auth::user()->district) {
            abort(403);
        }

        $requiresOpinion = $request->opinion == '1';

        $registration->update([
            'expert_opinion_required' => $requiresOpinion,
            'status' => $requiresOpinion ? 'Expert Opinion Requested' : 'Expert Opinion Not Required'
        ]);

        return redirect()->back()->with('success', 'Case updated successfully.');
    }
}
