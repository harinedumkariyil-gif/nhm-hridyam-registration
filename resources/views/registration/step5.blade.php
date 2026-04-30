@extends('layouts.app')

@section('content')
<div class="step-indicator">
    <div class="step completed">1</div>
    <div class="step completed">2</div>
    <div class="step completed">3</div>
    <div class="step completed">4</div>
    <div class="step active">5</div>
    <div class="step">6</div>
    <div class="step">7</div>
</div>

<h2 style="margin-bottom: 1.5rem; color: var(--primary);">Medical Details</h2>

<form action="{{ route('register.postStep', ['step' => 5]) }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label>Child Blood Group</label>
        <select name="child_blood_group">
            <option value="">-- Select --</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>
    </div>

    <div class="form-group">
        <label>Mother Blood Group</label>
        <select name="mother_blood_group">
            <option value="">-- Select --</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>
    </div>

    <div class="form-group">
        <label>Birth Weight (grams)</label>
        <input type="text" name="birth_weight_grams" value="{{ old('birth_weight_grams', $registration->birth_weight_grams ?? '') }}">
    </div>

    <div class="form-group">
        <label>Current Weight (kg)</label>
        <input type="text" name="current_weight_kg" value="{{ old('current_weight_kg', $registration->current_weight_kg ?? '') }}">
    </div>

    <div class="form-group">
        <label>Associated Conditions</label>
        <div style="display: grid; gap: 0.5rem;">
            @php $conditions = json_decode($registration->associated_conditions ?? '[]'); @endphp
            <label style="font-weight: 400;"><input type="checkbox" name="associated_conditions[]" value="Low Birth Weight" {{ in_array('Low Birth Weight', $conditions) ? 'checked' : '' }}> Low Birth Weight</label>
            <label style="font-weight: 400;"><input type="checkbox" name="associated_conditions[]" value="Pulm HTN" {{ in_array('Pulm HTN', $conditions) ? 'checked' : '' }}> Pulm HTN</label>
            <label style="font-weight: 400;"><input type="checkbox" name="associated_conditions[]" value="CCF" {{ in_array('CCF', $conditions) ? 'checked' : '' }}> CCF</label>
            <label style="font-weight: 400;"><input type="checkbox" name="associated_conditions[]" value="Malnutrition" {{ in_array('Malnutrition', $conditions) ? 'checked' : '' }}> Malnutrition</label>
            <label style="font-weight: 400;"><input type="checkbox" name="associated_conditions[]" value="Down's Syndrome" {{ in_array("Down's Syndrome", $conditions) ? 'checked' : '' }}> Down's Syndrome</label>
            <label style="font-weight: 400;"><input type="checkbox" name="associated_conditions[]" value="Multiple procedures" {{ in_array('Multiple procedures', $conditions) ? 'checked' : '' }}> Multiple procedures required</label>
        </div>
    </div>

    <div class="form-group">
        <label>Remarks</label>
        <textarea name="medical_remarks" rows="3" style="width: 100%; border: 1px solid var(--border); border-radius: 8px; padding: 0.75rem;">{{ old('medical_remarks', $registration->medical_remarks ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn" style="margin-top: 1.5rem;">Save & Next</button>
</form>

<div class="token-info">
    Application Resume Token: <br><strong>{{ $registration->token }}</strong>
</div>
@endsection
