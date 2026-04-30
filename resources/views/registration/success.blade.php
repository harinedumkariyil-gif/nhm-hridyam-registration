@extends('layouts.app')

@section('content')
<div class="step-indicator">
    <div class="step completed">1</div>
    <div class="step completed">2</div>
    <div class="step completed">3</div>
    <div class="step completed">4</div>
    <div class="step completed">5</div>
    <div class="step completed">6</div>
    <div class="step completed">7</div>
</div>

<div style="text-align: center; padding: 2rem 0;">
    <div style="width: 80px; height: 80px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 1.5rem;">
        ✓
    </div>
    <h2 style="color: #047857; margin-bottom: 1rem;">Registration Successful!</h2>
    <p style="color: var(--text-main); margin-bottom: 2rem;">Your application has been submitted successfully for verification.</p>
    
    <div style="background: #f1f5f9; padding: 1.5rem; border-radius: 8px; border: 1px dashed var(--border); margin-bottom: 2rem;">
        <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0.5rem;">Your Registration Token ID</p>
        <p style="font-size: 1.25rem; font-weight: 700; color: var(--primary); letter-spacing: 1px;">{{ $token }}</p>
        <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.5rem;">Please save this token for future reference.</p>
    </div>

    <a href="{{ route('register.index') }}" class="btn">Return to Home</a>
</div>
@endsection
