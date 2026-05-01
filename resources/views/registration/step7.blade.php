@extends('layouts.app')

@section('content')
<style>
    .diagnosis-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .diagnosis-table th, .diagnosis-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border);
    }
    .diagnosis-table th {
        background: #f1f5f9;
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--text-main);
    }
    .diagnosis-table td {
        font-size: 0.875rem;
        color: var(--text-muted);
    }
    .btn-danger {
        background: #ef4444;
        color: white;
        border: none;
        padding: 0.25rem 0.75rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.75rem;
        transition: background 0.2s;
    }
    .btn-danger:hover {
        background: #dc2626;
    }
    .add-form-container {
        background: #f8fafc;
        border: 1px dashed var(--border);
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }
</style>

<div class="step-indicator">
    <div class="step completed">1</div>
    <div class="step completed">2</div>
    <div class="step completed">3</div>
    <div class="step completed">4</div>
    <div class="step completed">5</div>
    <div class="step completed">6</div>
    <div class="step active">7</div>
</div>

<h2 style="margin-bottom: 1.5rem; color: var(--primary);">Diagnosis Details</h2>

@if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div style="background: #ecfdf5; color: #065f46; padding: 1rem; border-radius: 8px; border: 1px solid #a7f3d0; margin-bottom: 1.5rem; font-size: 0.875rem;">
        {{ session('success') }}
    </div>
@endif

@if($registration->diagnoses->count() > 0)
    <h3 style="font-size: 1.125rem; margin-bottom: 1rem; color: var(--text-main);">Added Diagnoses</h3>
    <table class="diagnosis-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Diagnosis</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registration->diagnoses as $diag)
            <tr>
                <td>{{ \Carbon\Carbon::parse($diag->diagnosis_date)->format('d M Y') }}</td>
                <td>{{ $diag->diagnosisType->name ?? '-' }}</td>
                <td>{{ $diag->diagnosis->name ?? '-' }}</td>
                <td>{{ $diag->category->name ?? '-' }}</td>
                <td>
                    <form action="{{ route('register.deleteDiagnosis', $diag->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to remove this diagnosis?')">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

<div class="add-form-container">
    <h3 style="font-size: 1.125rem; margin-bottom: 1rem; color: var(--text-main);">Add Diagnosis</h3>
    <form action="{{ route('register.addDiagnosis') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Date of Diagnosis</label>
            <input type="date" name="diagnosis_date" required>
        </div>

        <div class="form-group">
            <label>Diagnosis Type</label>
            <select name="diagnosis_type_id" required>
                <option value="">Select Diagnosis Type</option>
                @foreach($diagnosisTypes as $dt)
                    <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Diagnosis</label>
            <input type="text" id="diagnosisSearch" placeholder="Search diagnosis..." style="margin-bottom: 0.5rem; padding: 0.5rem; font-size: 0.875rem;">
            <select name="diagnosis_id" id="diagnosisSelect" required>
                <option value="">Select Diagnosis</option>
                @foreach($diagnoses as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>

        <script>
            document.getElementById('diagnosisSearch').addEventListener('input', function(e) {
                const search = e.target.value.toLowerCase();
                const select = document.getElementById('diagnosisSelect');
                const options = select.getElementsByTagName('option');
                
                for (let i = 1; i < options.length; i++) {
                    const text = options[i].innerText.toLowerCase();
                    options[i].style.display = text.includes(search) ? '' : 'none';
                }
            });
        </script>

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn" style="background: var(--text-main);">+ Add Diagnosis</button>
    </form>
</div>

<h2 style="margin: 2.5rem 0 1.5rem; color: var(--primary); border-top: 1px solid var(--border); padding-top: 2rem;">Attachments</h2>

<form action="{{ route('register.postStep', ['step' => 7]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group">
        <label>Medical Report Document (Required)</label>
        <input type="file" name="medical_report_path" accept=".pdf,image/*" required style="width: 100%; border: 1px dashed var(--border); padding: 1rem; background: #fafafa; border-radius: 8px;">
    </div>

    <div class="form-group">
        <label>Aadhaar Document (Required)</label>
        <input type="file" name="aadhaar_path" accept=".pdf,image/*" required style="width: 100%; border: 1px dashed var(--border); padding: 1rem; background: #fafafa; border-radius: 8px;">
    </div>

    <div class="form-group">
        <label>Birth Certificate Document</label>
        <input type="file" name="birth_certificate_path" accept=".pdf,image/*" style="width: 100%; border: 1px dashed var(--border); padding: 1rem; background: #fafafa; border-radius: 8px;">
    </div>

    <div class="form-group">
        <label>Ration Card Document (Required for BPL)</label>
        <input type="file" name="ration_card_path" accept=".pdf,image/*" style="width: 100%; border: 1px dashed var(--border); padding: 1rem; background: #fafafa; border-radius: 8px;">
    </div>

    <div class="form-group" style="display: flex; align-items: start; gap: 0.5rem; margin-top: 1.5rem;">
        <input type="checkbox" name="declaration" id="declaration" required style="width: 20px; height: 20px; margin-top: 0.1rem;">
        <label for="declaration" style="font-weight: 400; font-size: 0.875rem;">I hereby declare that the information provided above is true and correct to the best of my knowledge.</label>
    </div>

    <button type="submit" class="btn" style="margin-top: 1.5rem;">Final Submit</button>
</form>

<div class="token-info">
    Application Resume Token: <br><strong>{{ $registration->token }}</strong>
</div>
@endsection
