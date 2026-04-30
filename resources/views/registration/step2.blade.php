@extends('layouts.app')

@section('content')
<div class="step-indicator">
    <div class="step completed">1</div>
    <div class="step active">2</div>
    <div class="step">3</div>
    <div class="step">4</div>
    <div class="step">5</div>
    <div class="step">6</div>
    <div class="step">7</div>
</div>

<h2 style="margin-bottom: 1.5rem; color: var(--primary);">Basic Details</h2>

<div style="background: #f8fafc; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid var(--border);">
    <h3 style="font-size: 1rem; margin-bottom: 1rem; color: var(--text-muted);">From Registration</h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div>
            <label style="font-size: 0.75rem; color: var(--text-muted);">Name</label>
            <div style="font-weight: 500;">{{ $registration->patient_name }}</div>
        </div>
        <div>
            <label style="font-size: 0.75rem; color: var(--text-muted);">Gender</label>
            <div style="font-weight: 500;">{{ $registration->gender }}</div>
        </div>
        <div>
            <label style="font-size: 0.75rem; color: var(--text-muted);">Date of Birth</label>
            <div style="font-weight: 500;">{{ $registration->dob }}</div>
        </div>
        <div>
            <label style="font-size: 0.75rem; color: var(--text-muted);">Contact Number</label>
            <div style="font-weight: 500;">{{ $registration->mobile }}</div>
        </div>
    </div>
</div>

<form action="{{ route('register.postStep', ['step' => 2]) }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label>RCH ID</label>
        <input type="text" name="rch_id" placeholder="Enter RCH ID" value="{{ old('rch_id', $registration->rch_id ?? '') }}">
    </div>

    <div class="form-group">
        <label>Father Name</label>
        <input type="text" name="father_name" placeholder="Enter Father Name" value="{{ old('father_name', $registration->father_name ?? '') }}">
    </div>

    <div class="form-group">
        <label>Mother Name</label>
        <input type="text" name="mother_name" placeholder="Enter Mother Name" value="{{ old('mother_name', $registration->mother_name ?? '') }}">
    </div>

    <div class="form-group">
        <label>Email ID</label>
        <input type="email" name="email" placeholder="Enter Email ID" value="{{ old('email', $registration->email ?? '') }}">
    </div>

    <button type="submit" class="btn" style="margin-top: 1.5rem;">Save & Next</button>
</form>

<div class="token-info">
    Application Resume Token: <br><strong>{{ $registration->token }}</strong>
</div>
@endsection
