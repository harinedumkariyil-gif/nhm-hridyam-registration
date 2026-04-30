@extends('layouts.app')

@section('content')
<div class="step-indicator">
    <div class="step completed">1</div>
    <div class="step completed">2</div>
    <div class="step completed">3</div>
    <div class="step completed">4</div>
    <div class="step completed">5</div>
    <div class="step active">6</div>
    <div class="step">7</div>
</div>

<h2 style="margin-bottom: 1.5rem; color: var(--primary);">Present Clinical Details</h2>

<form action="{{ route('register.postStep', ['step' => 6]) }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label>Baby Color</label>
        <select name="baby_color">
            <option value="">-- Select --</option>
            <option value="Pink / Acynotic">Pink / Acynotic</option>
            <option value="Cynotic">Cynotic</option>
        </select>
    </div>

    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
        <input type="checkbox" name="clinical_symptoms" value="1" id="clinical_symptoms" style="width: 20px; height: 20px;">
        <label for="clinical_symptoms" style="margin-bottom: 0;">Clinical Symptoms Present?</label>
    </div>

    <div class="form-group" style="margin-top: 1rem;">
        <label>Saturation Maintained</label>
        <select name="saturation_maintained">
            <option value="">-- Select --</option>
            <option value="With Oxygen">With Oxygen</option>
            <option value="With Out Oxygen">With Out Oxygen</option>
        </select>
    </div>

    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
        <input type="checkbox" name="cynotic_spells" value="1" id="cynotic_spells" style="width: 20px; height: 20px;">
        <label for="cynotic_spells" style="margin-bottom: 0;">Cynotic Spells</label>
    </div>

    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
        <input type="checkbox" name="sweating_forehead" value="1" id="sweating_forehead" style="width: 20px; height: 20px;">
        <label for="sweating_forehead" style="margin-bottom: 0;">Sweating over forehead</label>
    </div>

    <div class="form-group" style="margin-top: 1rem;">
        <label>Murmur</label>
        <select name="murmur">
            <option value="">-- Select --</option>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
    </div>

    <div class="form-group">
        <label>Heart Rate (BPM)</label>
        <input type="text" name="heart_rate" value="{{ old('heart_rate', $registration->heart_rate ?? '') }}">
    </div>

    <div class="form-group">
        <label>Respiratory Rate</label>
        <input type="text" name="respiratory_rate" value="{{ old('respiratory_rate', $registration->respiratory_rate ?? '') }}">
    </div>

    <div class="form-group">
        <label>Liver</label>
        <select name="liver">
            <option value="">-- Select --</option>
            <option value="Enlarged">Enlarged</option>
            <option value="Not Enlarged">Not Enlarged</option>
        </select>
    </div>

    <div class="form-group">
        <label>Femoral Pulse</label>
        <select name="femoral_pulse">
            <option value="">-- Select --</option>
            <option value="Palpable">Palpable</option>
            <option value="Not Palpable">Not Palpable</option>
        </select>
    </div>

    <div class="form-group">
        <label>SpO2 (%)</label>
        <input type="text" name="spo2" value="{{ old('spo2', $registration->spo2 ?? '') }}">
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div class="form-group">
            <label>SpO2 UL Right</label>
            <input type="text" name="spo2_ul_right">
        </div>
        <div class="form-group">
            <label>SpO2 UL Left</label>
            <input type="text" name="spo2_ul_left">
        </div>
        <div class="form-group">
            <label>SpO2 LL Right</label>
            <input type="text" name="spo2_ll_right">
        </div>
        <div class="form-group">
            <label>SpO2 LL Left</label>
            <input type="text" name="spo2_ll_left">
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div class="form-group">
            <label>BP Systolic</label>
            <input type="text" name="bp_systolic">
        </div>
        <div class="form-group">
            <label>BP Diastolic</label>
            <input type="text" name="bp_diastolic">
        </div>
    </div>

    <div class="form-group">
        <label>Remarks</label>
        <textarea name="clinical_remarks" rows="3" style="width: 100%; border: 1px solid var(--border); border-radius: 8px; padding: 0.75rem;">{{ old('clinical_remarks', $registration->clinical_remarks ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn" style="margin-top: 1.5rem;">Save & Next</button>
</form>

<div class="token-info">
    Application Resume Token: <br><strong>{{ $registration->token }}</strong>
</div>
@endsection
