@extends('layouts.app')

@section('content')
<div style="text-align: center; margin-bottom: 2rem;">
    <i class="fa-solid fa-user-shield" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
    <h2 style="justify-content: center;">DEIC Official Login</h2>
    <p style="color: var(--text-muted);">Access restricted to District Early Intervention Center staff.</p>
</div>

<form action="{{ route('deic.login') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Official Email ID</label>
        <div style="position: relative;">
            <i class="fa-solid fa-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="email" name="email" required placeholder="deic_district@hridyam.gov.in" style="padding-left: 3rem;">
        </div>
    </div>

    <div class="form-group">
        <label>Password</label>
        <div style="position: relative;">
            <i class="fa-solid fa-lock" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            <input type="password" name="password" required placeholder="••••••••" style="padding-left: 3rem;">
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <button type="submit" class="btn" style="margin-top: 1rem;">
        <i class="fa-solid fa-right-to-bracket"></i> Login to Dashboard
    </button>
    
    <div style="text-align: center; margin-top: 2rem; border-top: 1px solid var(--border); padding-top: 1.5rem;">
        <a href="{{ route('home') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.875rem;">
            <i class="fa-solid fa-arrow-left"></i> Back to Public Portal
        </a>
    </div>
</form>
@endsection
