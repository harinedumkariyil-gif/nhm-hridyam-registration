@extends('layouts.app')

@section('content')
<div class="step-indicator">
    <div class="step completed">1</div>
    <div class="step active">OTP</div>
    <div class="step">2</div>
    <div class="step">3</div>
    <div class="step">4</div>
    <div class="step">5</div>
    <div class="step">6</div>
</div>

<h2 style="margin-bottom: 1.5rem; color: var(--primary);">Verify Mobile Number</h2>

@if($errors->any())
    <div class="alert alert-error">
        {{ $errors->first() }}
    </div>
@endif

<div style="background: #e0f2fe; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; color: #0369a1; font-size: 0.875rem;">
    <strong>Demo:</strong> For testing, please enter OTP: <strong>123456</strong>
</div>

<form action="{{ route('register.verifyOtp') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Enter 6-digit OTP</label>
        <input type="text" name="otp" required pattern="\d{6}" placeholder="123456" style="letter-spacing: 0.5em; text-align: center; font-size: 1.25rem; font-weight: bold;">
    </div>

    <button type="submit" class="btn">Verify and Continue</button>
</form>

<div class="token-info">
    Application Resume Token: <br><strong>{{ $registration->token }}</strong><br>
    <small>Save this token to resume your application later.</small>
</div>
@endsection
