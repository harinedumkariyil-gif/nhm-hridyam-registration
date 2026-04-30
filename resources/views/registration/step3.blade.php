@extends('layouts.app')

@section('content')
<div class="step-indicator">
    <div class="step completed">1</div>
    <div class="step completed">2</div>
    <div class="step active">3</div>
    <div class="step">4</div>
    <div class="step">5</div>
    <div class="step">6</div>
    <div class="step">7</div>
</div>

<h2 style="margin-bottom: 1.5rem; color: var(--primary);">Residential Details</h2>

<form action="{{ route('register.postStep', ['step' => 3]) }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label>Address Line 1</label>
        <input type="text" name="address_line_1" required value="{{ old('address_line_1', $registration->address_line_1 ?? '') }}">
    </div>

    <div class="form-group">
        <label>Address Line 2</label>
        <input type="text" name="address_line_2" value="{{ old('address_line_2', $registration->address_line_2 ?? '') }}">
    </div>

    <div class="form-group">
        <label>Address Line 3</label>
        <input type="text" name="address_line_3" value="{{ old('address_line_3', $registration->address_line_3 ?? '') }}">
    </div>

    <div class="form-group">
        <label>Post Office</label>
        <input type="text" name="post_office" required value="{{ old('post_office', $registration->post_office ?? '') }}">
    </div>

    <div class="form-group">
        <label>Pincode</label>
        <input type="text" name="pincode" required pattern="\d{6}" value="{{ old('pincode', $registration->pincode ?? '') }}">
    </div>

    <div class="form-group">
        <label>District</label>
        <select name="district" required>
            <option value="{{ $registration->district }}">{{ $registration->district }}</option>
        </select>
    </div>

    <div class="form-group">
        <label>Living In</label>
        <select name="living_in" required>
            <option value="">-- Select --</option>
            <option value="Panchayat">Panchayat</option>
            <option value="Municipality">Municipality</option>
            <option value="Corporation">Corporation</option>
        </select>
    </div>

    <div class="form-group">
        <label>Local Body</label>
        <input type="text" name="local_body" required value="{{ old('local_body', $registration->local_body ?? '') }}">
    </div>

    <div class="form-group">
        <label>Alternate Contact No</label>
        <input type="text" name="alternate_contact" pattern="\d{10}" value="{{ old('alternate_contact', $registration->alternate_contact ?? '') }}">
    </div>

    <h3 style="font-size: 1.125rem; margin: 2rem 0 1rem; color: var(--text-main);">Current Hospital Details</h3>

    <div class="form-group">
        <label>Hospital Name</label>
        <input type="text" name="hospital_name" required value="{{ old('hospital_name', $registration->hospital_name ?? '') }}">
    </div>

    <div class="form-group">
        <label>Doctor Name</label>
        <input type="text" name="doctor_name" value="{{ old('doctor_name', $registration->doctor_name ?? '') }}">
    </div>

    <div class="form-group">
        <label>Hospital Contact No</label>
        <input type="text" name="hospital_contact_no" value="{{ old('hospital_contact_no', $registration->hospital_contact_no ?? '') }}">
    </div>

    <button type="submit" class="btn" style="margin-top: 1.5rem;">Save & Next</button>
</form>

<div class="token-info">
    Application Resume Token: <br><strong>{{ $registration->token }}</strong>
</div>
@endsection
