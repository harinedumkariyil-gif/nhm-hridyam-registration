@extends('layouts.app')

@section('content')
<div class="step-indicator">
    <div class="step completed">1</div>
    <div class="step completed">2</div>
    <div class="step completed">3</div>
    <div class="step active">4</div>
    <div class="step">5</div>
    <div class="step">6</div>
    <div class="step">7</div>
</div>

<h2 style="margin-bottom: 1.5rem; color: var(--primary);">Socio-economic Details</h2>

<form action="{{ route('register.postStep', ['step' => 4]) }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label>Category (BPL/APL)</label>
        <select name="bpl_apl" required>
            <option value="">-- Select --</option>
            <option value="BPL">BPL</option>
            <option value="APL">APL</option>
        </select>
    </div>

    <div class="form-group">
        <label>Sub Category</label>
        <input type="text" name="sub_category" value="{{ old('sub_category', $registration->sub_category ?? '') }}">
    </div>

    <div class="form-group">
        <label>Ration Card No</label>
        <input type="text" name="ration_card_no" required value="{{ old('ration_card_no', $registration->ration_card_no ?? '') }}">
    </div>

    <div class="form-group">
        <label>Annual Income</label>
        <input type="number" name="annual_income" value="{{ old('annual_income', $registration->annual_income ?? '') }}">
    </div>

    <div class="form-group">
        <label>Caste</label>
        <select name="caste">
            <option value="">-- Select --</option>
            <option value="SC">SC</option>
            <option value="ST">ST</option>
            <option value="OEC">OEC</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="form-group">
        <label>Aadhaar No</label>
        <input type="text" name="aadhaar_no" required pattern="\d{12}" placeholder="12-digit Aadhaar number">
        <small style="color: var(--text-muted); font-size: 0.75rem;">Securely encrypted in compliance with data privacy regulations.</small>
    </div>

    <h3 style="font-size: 1.125rem; margin: 2rem 0 1rem; color: var(--text-main);">Birth Details</h3>

    <div class="form-group">
        <label>Type of Delivery</label>
        <select name="delivery_type" required>
            <option value="">-- Select --</option>
            <option value="Normal">Normal</option>
            <option value="LSCS">LSCS (Caesarean)</option>
        </select>
    </div>

    <div class="form-group">
        <label>Birth Weight (kg)</label>
        <input type="number" name="birth_weight" step="0.01" value="{{ old('birth_weight', $registration->birth_weight ?? '') }}">
    </div>

    <div class="form-group">
        <label>Order of Birth</label>
        <select name="order_of_birth">
            <option value="">-- Select --</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="Above 5">Above 5</option>
        </select>
    </div>

    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
        <input type="checkbox" name="consanguinity" value="1" id="consanguinity" style="width: 20px; height: 20px;">
        <label for="consanguinity" style="margin-bottom: 0;">Consanguinity (Blood relation between parents)</label>
    </div>

    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
        <input type="checkbox" name="antenatal_diagnosis" value="1" id="antenatal_diagnosis" style="width: 20px; height: 20px;">
        <label for="antenatal_diagnosis" style="margin-bottom: 0;">Antenatal Diagnosis (Diagnosed before birth)</label>
    </div>

    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
        <input type="checkbox" name="other_illness_mother" value="1" id="other_illness_mother" style="width: 20px; height: 20px;">
        <label for="other_illness_mother" style="margin-bottom: 0;">Other Illness for Mother</label>
    </div>

    <button type="submit" class="btn" style="margin-top: 1.5rem;">Save & Next</button>
</form>

<div class="token-info">
    Application Resume Token: <br><strong>{{ $registration->token }}</strong>
</div>
@endsection
