@extends('layouts.app')

@section('content')
<h2 style="margin-bottom: 1.5rem; color: var(--primary); text-align: center;">Resume Application</h2>

@if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('register.resumePost') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Enter Resume Token</label>
        <input type="text" name="token" required placeholder="Paste your application token here">
    </div>

    <button type="submit" class="btn">Resume Application</button>
    
    <div style="text-align: center; margin-top: 1.5rem;">
        <a href="{{ route('register.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.875rem;">Start New Application</a>
    </div>
</form>
@endsection
