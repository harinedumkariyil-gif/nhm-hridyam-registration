<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration.step1');
    }

    public function postStep1(Request $request)
    {
        $request->validate([
            'patient_name' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'district' => 'required',
            'mobile' => 'required|digits:10',
        ]);

        do {
            $token = strtoupper(Str::random(6));
        } while (Registration::where('token', $token)->exists());
        
        $registration = Registration::create([
            'token' => $token,
            'current_step' => 1,
            'patient_name' => $request->patient_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'district' => $request->district,
            'mobile' => $request->mobile,
            'otp' => '123456', // Mock OTP
        ]);

        Session::put('registration_token', $token);

        return redirect()->route('register.showStep', ['step' => 'otp']);
    }

    public function verifyOtp(Request $request)
    {
        $token = Session::get('registration_token');
        if (!$token) return redirect()->route('register.index');

        $registration = Registration::where('token', $token)->firstOrFail();
        
        if ($request->otp == $registration->otp) {
            $registration->update([
                'otp_verified_at' => now(),
                'current_step' => 2
            ]);
            return redirect()->route('register.showStep', ['step' => 2]);
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }

    public function showStep($step)
    {
        $token = Session::get('registration_token');
        if (!$token) return redirect()->route('register.index');

        $registration = Registration::where('token', $token)->firstOrFail();
        
        if ($step === 'otp') {
            return view('registration.otp', compact('registration'));
        }

        if ($step > $registration->current_step) {
            return redirect()->route('register.showStep', ['step' => $registration->current_step]);
        }

        if ($step == 7) {
            $diagnosisTypes = \App\Models\DiagnosisType::all();
            $diagnoses = \App\Models\Diagnosis::all();
            $categories = \App\Models\Category::all();
            return view('registration.step7', compact('registration', 'diagnosisTypes', 'diagnoses', 'categories'));
        }

        return view('registration.step' . $step, compact('registration'));
    }

    public function postStep(Request $request, $step)
    {
        $token = Session::get('registration_token');
        if (!$token) return redirect()->route('register.index');

        $registration = Registration::where('token', $token)->firstOrFail();

        if ($step == 2) {
            $registration->update([
                'rch_id' => $request->rch_id,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'email' => $request->email,
                'current_step' => 3
            ]);
        } elseif ($step == 3) {
            $registration->update([
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'address_line_3' => $request->address_line_3,
                'post_office' => $request->post_office,
                'pincode' => $request->pincode,
                'district' => $request->district,
                'living_in' => $request->living_in,
                'local_body' => $request->local_body,
                'alternate_contact' => $request->alternate_contact,
                'hospital_name' => $request->hospital_name,
                'doctor_name' => $request->doctor_name,
                'hospital_contact_no' => $request->hospital_contact_no,
                'current_step' => 4
            ]);
        } elseif ($step == 4) {
            $registration->update([
                'bpl_apl' => $request->bpl_apl,
                'sub_category' => $request->sub_category,
                'ration_card_no' => $request->ration_card_no,
                'annual_income' => $request->annual_income,
                'caste' => $request->caste,
                'aadhaar_no' => $request->aadhaar_no ? Crypt::encryptString($request->aadhaar_no) : null,
                'delivery_type' => $request->delivery_type,
                'birth_weight' => $request->birth_weight,
                'order_of_birth' => $request->order_of_birth,
                'consanguinity' => $request->has('consanguinity') && $request->consanguinity == '1',
                'antenatal_diagnosis' => $request->has('antenatal_diagnosis') && $request->antenatal_diagnosis == '1',
                'other_illness_mother' => $request->has('other_illness_mother') && $request->other_illness_mother == '1',
                'current_step' => 5
            ]);
        } elseif ($step == 5) {
            $registration->update([
                'child_blood_group' => $request->child_blood_group,
                'mother_blood_group' => $request->mother_blood_group,
                'birth_weight_grams' => $request->birth_weight_grams,
                'current_weight_kg' => $request->current_weight_kg,
                'associated_conditions' => json_encode($request->associated_conditions ?? []),
                'medical_remarks' => $request->medical_remarks,
                'current_step' => 6
            ]);
        } elseif ($step == 6) {
            $registration->update([
                'baby_color' => $request->baby_color,
                'clinical_symptoms' => $request->has('clinical_symptoms') && $request->clinical_symptoms == '1',
                'saturation_maintained' => $request->saturation_maintained,
                'cynotic_spells' => $request->has('cynotic_spells') && $request->cynotic_spells == '1',
                'sweating_forehead' => $request->has('sweating_forehead') && $request->sweating_forehead == '1',
                'murmur' => $request->murmur,
                'heart_rate' => $request->heart_rate,
                'respiratory_rate' => $request->respiratory_rate,
                'liver' => $request->liver,
                'femoral_pulse' => $request->femoral_pulse,
                'spo2' => $request->spo2,
                'spo2_ul_right' => $request->spo2_ul_right,
                'spo2_ul_left' => $request->spo2_ul_left,
                'spo2_ll_right' => $request->spo2_ll_right,
                'spo2_ll_left' => $request->spo2_ll_left,
                'bp_systolic' => $request->bp_systolic,
                'bp_diastolic' => $request->bp_diastolic,
                'clinical_remarks' => $request->clinical_remarks,
                'current_step' => 7
            ]);
        } elseif ($step == 7) {
            if ($registration->diagnoses()->count() == 0) {
                return back()->with('error', 'Please add at least one diagnosis to continue.');
            }

            if ($request->hasFile('medical_report_path')) {
                $registration->update(['medical_report_path' => $request->file('medical_report_path')->store('reports')]);
            }
            if ($request->hasFile('aadhaar_path')) {
                $registration->update(['aadhaar_path' => $request->file('aadhaar_path')->store('reports')]);
            }
            if ($request->hasFile('birth_certificate_path')) {
                $registration->update(['birth_certificate_path' => $request->file('birth_certificate_path')->store('reports')]);
            }
            if ($request->hasFile('ration_card_path')) {
                $registration->update(['ration_card_path' => $request->file('ration_card_path')->store('reports')]);
            }
            
            // Final submit
            Session::forget('registration_token');
            return view('registration.success', [
                'token' => $registration->token,
                'registration' => $registration
            ]);
        }

        return redirect()->route('register.showStep', ['step' => $step + 1]);
    }

    public function resumeForm()
    {
        return view('registration.resume');
    }

    public function resumePost(Request $request)
    {
        $request->validate(['token' => 'required']);
        $registration = Registration::where('token', $request->token)->first();
        if (!$registration) {
            return back()->with('error', 'Invalid token. Please check and try again.');
        }
        
        return redirect()->route('register.resume', ['token' => $registration->token]);
    }

    public function resume($token)
    {
        $registration = Registration::where('token', $token)->firstOrFail();
        Session::put('registration_token', $token);
        
        $step = $registration->current_step;

        if ($step == 7) {
            return view('registration.success', [
                'token' => $registration->token,
                'registration' => $registration
            ]);
        }

        if ($step == 1 && !$registration->otp_verified_at) {
            return redirect()->route('register.showStep', ['step' => 'otp']);
        }
        return redirect()->route('register.showStep', ['step' => $step]);
    }

    public function addDiagnosis(Request $request)
    {
        $token = Session::get('registration_token');
        if (!$token) return redirect()->route('register.index');

        $registration = Registration::where('token', $token)->firstOrFail();

        $request->validate([
            'diagnosis_date' => 'required|date',
            'diagnosis_type_id' => 'required',
            'diagnosis_id' => 'required',
            'category_id' => 'required',
        ]);

        \App\Models\RegistrationDiagnosis::create([
            'registration_id' => $registration->id,
            'diagnosis_date' => $request->diagnosis_date,
            'diagnosis_type_id' => $request->diagnosis_type_id,
            'diagnosis_id' => $request->diagnosis_id,
            'category_id' => $request->category_id,
        ]);

        return back()->with('success', 'Diagnosis added successfully.');
    }

    public function deleteDiagnosis($id)
    {
        $token = Session::get('registration_token');
        if (!$token) return redirect()->route('register.index');

        $registration = Registration::where('token', $token)->firstOrFail();
        
        $diag = \App\Models\RegistrationDiagnosis::where('id', $id)
            ->where('registration_id', $registration->id)
            ->firstOrFail();
            
        $diag->delete();

        return back()->with('success', 'Diagnosis removed.');
    }
}
