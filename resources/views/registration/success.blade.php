@extends('layouts.app')

@section('content')
<div style="text-align: center; padding-bottom: 2rem; border-bottom: 2px solid var(--border); margin-bottom: 2rem;">
    <div style="width: 80px; height: 80px; background: var(--accent); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 1.5rem; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
        <i class="fa-solid fa-check"></i>
    </div>
    <h2 style="color: var(--accent); margin-bottom: 0.5rem; justify-content: center;">Registration Successful!</h2>
    <p style="color: var(--text-muted);">Your application has been submitted and is under review.</p>
</div>

<div style="background: white; border-radius: var(--radius); border: 1px solid var(--border); overflow: hidden; box-shadow: var(--shadow); margin-bottom: 2rem;">
    <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%); padding: 1.5rem; color: white; display: flex; align-items: center; justify-content: space-between;">
        <h3 style="font-size: 1.25rem; font-weight: 700;">Patient Profile</h3>
        <span style="background: rgba(255,255,255,0.2); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">ID: {{ $token }}</span>
    </div>
    
    <div style="padding: 2rem; display: flex; gap: 2rem; align-items: start;">
        <div style="flex-shrink: 0;">
            <div style="width: 150px; height: 180px; border-radius: 12px; overflow: hidden; border: 4px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); background: #f1f5f9;">
                <img src="{{ asset('profile.jpg') }}" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <p style="text-align: center; font-size: 0.75rem; color: var(--text-muted); margin-top: 0.5rem; font-weight: 600;">PATIENT PHOTO</p>
        </div>
        
        <div style="flex-grow: 1; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Full Name</label>
                <div style="font-size: 1.125rem; font-weight: 700; color: var(--text-main);">{{ $registration->patient_name }}</div>
            </div>
            <div>
                <label style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Gender</label>
                <div style="font-size: 1.125rem; font-weight: 700; color: var(--text-main);">{{ $registration->gender }}</div>
            </div>
            <div>
                <label style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Date of Birth</label>
                <div style="font-size: 1.125rem; font-weight: 700; color: var(--text-main);">{{ \Carbon\Carbon::parse($registration->dob)->format('d M Y') }}</div>
            </div>
            <div>
                <label style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">District</label>
                <div style="font-size: 1.125rem; font-weight: 700; color: var(--text-main);">{{ $registration->district }}</div>
            </div>
            <div style="grid-column: span 2;">
                <label style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Contact Number</label>
                <div style="font-size: 1.125rem; font-weight: 700; color: var(--primary);">{{ $registration->mobile }}</div>
            </div>
        </div>
    </div>
    
    <div style="background: #f8fafc; padding: 1.5rem; border-top: 1px solid var(--border); display: flex; justify-content: center; gap: 1rem;">
        <button onclick="window.print()" class="btn" style="width: auto; padding: 0.75rem 1.5rem; background: var(--text-main); font-size: 0.875rem;">
            <i class="fa-solid fa-print"></i> Print Acknowledgement
        </button>
        <a href="{{ route('home') }}" class="btn" style="width: auto; padding: 0.75rem 1.5rem; font-size: 0.875rem;">
            <i class="fa-solid fa-house"></i> Back to Home
        </a>
    </div>
</div>

<div class="token-info" style="margin-top: 0;">
    <p>Please keep your reference token safe to track your status.</p>
    <strong>{{ $token }}</strong>
</div>
@endsection
