@extends('layouts.app')

@section('content')
<div class="step-indicator">
    <div class="step active">1</div>
    <div class="step">2</div>
    <div class="step">3</div>
    <div class="step">4</div>
    <div class="step">5</div>
    <div class="step">6</div>
    <div class="step">7</div>
</div>

<h2 style="margin-bottom: 1.5rem; color: var(--primary);">Public Registration - Basic Details</h2>

@if($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register.step1') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="patient_name" required placeholder="Enter patient name" value="{{ old('patient_name', $registration->patient_name ?? '') }}">
    </div>

    <div class="form-group" style="margin-bottom: 1rem;">
        <label>Gender</label>
        <div style="display: flex; gap: 1rem;">
            <label style="font-weight: 400;"><input type="radio" name="gender" value="Male" required> Male</label>
            <label style="font-weight: 400;"><input type="radio" name="gender" value="Female" required> Female</label>
            <label style="font-weight: 400;"><input type="radio" name="gender" value="Other" required> Other</label>
        </div>
    </div>

    <div class="form-group">
        <label>Date of Birth</label>
        <input type="date" name="dob" required>
    </div>

    <div class="form-group">
        <label>District (ജില്ല)</label>
        <select name="district" required>
            <option value="">-- Select District (ജില്ല തിരഞ്ഞെടുക്കുക) --</option>
            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
            <option value="Kollam">Kollam</option>
            <option value="Pathanamthitta">Pathanamthitta</option>
            <option value="Alappuzha">Alappuzha</option>
            <option value="Kottayam">Kottayam</option>
            <option value="Idukki">Idukki</option>
            <option value="Ernakulam">Ernakulam</option>
            <option value="Thrissur">Thrissur</option>
            <option value="Palakkad">Palakkad</option>
            <option value="Malappuram">Malappuram</option>
            <option value="Kozhikode">Kozhikode</option>
            <option value="Wayanad">Wayanad</option>
            <option value="Kannur">Kannur</option>
            <option value="Kasaragod">Kasaragod</option>
        </select>
    </div>

    <div class="form-group">
        <label>Contact Number (ബന്ധപ്പെടേണ്ട നമ്പർ)</label>
        <input type="text" name="mobile" required pattern="\d{10}" title="10 digit mobile number" placeholder="Enter Phone Number">
        <small style="color: var(--text-muted); font-size: 0.75rem;">One time password (OTP) will send to this contact number..</small>
    </div>

    <div class="form-group" style="display: flex; align-items: start; gap: 0.5rem; margin-top: 1.5rem;">
        <input type="checkbox" name="terms" id="terms" required style="width: 20px; height: 20px; margin-top: 0.1rem;">
        <label for="terms" style="font-weight: 400; font-size: 0.875rem; margin-bottom: 0;">I agree to the Terms and Conditions</label>
    </div>

    <button type="submit" class="btn" style="margin-top: 1.5rem;">Save & Next ( വിവരങ്ങൾ സൂക്ഷിക്കുക & അടുത്തത് )</button>

    <div style="text-align: center; margin-top: 1.5rem;">
        <a href="{{ route('register.resumeForm') }}" style="color: var(--primary); text-decoration: none; font-size: 0.875rem; font-weight: 500;">Already started? Resume Application</a>
    </div>
</form>
@endsection
