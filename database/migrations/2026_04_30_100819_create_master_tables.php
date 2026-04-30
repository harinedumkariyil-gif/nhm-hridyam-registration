<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('days')->default(0);
            $table->boolean('status')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('diagnosis_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosis_type_id')->constrained('diagnosis_types')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('name');
            $table->string('icd_code')->nullable();
            $table->timestamps();
        });

        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique(); // to resume application
            $table->integer('current_step')->default(1);
            
            // Step 1
            $table->string('patient_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('district')->nullable();
            $table->string('mobile')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_verified_at')->nullable();
            
            // Step 2
            $table->string('rch_id')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('email')->nullable();

            // Step 3
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('address_line_3')->nullable();
            $table->string('post_office')->nullable();
            $table->string('pincode')->nullable();
            $table->string('living_in')->nullable();
            $table->string('local_body')->nullable();
            $table->string('alternate_contact')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('hospital_contact_no')->nullable();

            // Step 4
            $table->string('bpl_apl')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('ration_card_no')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('caste')->nullable();
            $table->text('aadhaar_no')->nullable(); // Encrypted
            $table->string('delivery_type')->nullable();
            $table->decimal('birth_weight', 5, 2)->nullable();
            $table->string('order_of_birth')->nullable();
            $table->boolean('consanguinity')->nullable();
            $table->boolean('antenatal_diagnosis')->nullable();
            $table->boolean('other_illness_mother')->nullable();

            // Step 5
            $table->string('child_blood_group')->nullable();
            $table->string('mother_blood_group')->nullable();
            $table->string('birth_weight_grams')->nullable();
            $table->string('current_weight_kg')->nullable();
            $table->json('associated_conditions')->nullable();
            $table->text('medical_remarks')->nullable();

            // Step 6
            $table->string('baby_color')->nullable();
            $table->boolean('clinical_symptoms')->nullable();
            $table->string('saturation_maintained')->nullable();
            $table->boolean('cynotic_spells')->nullable();
            $table->boolean('sweating_forehead')->nullable();
            $table->string('murmur')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('liver')->nullable();
            $table->string('femoral_pulse')->nullable();
            $table->string('spo2')->nullable();
            $table->string('spo2_ul_right')->nullable();
            $table->string('spo2_ul_left')->nullable();
            $table->string('spo2_ll_right')->nullable();
            $table->string('spo2_ll_left')->nullable();
            $table->string('bp_systolic')->nullable();
            $table->string('bp_diastolic')->nullable();
            $table->text('clinical_remarks')->nullable();

            // Step 7
            $table->string('medical_report_path')->nullable();
            $table->string('aadhaar_path')->nullable();
            $table->string('birth_certificate_path')->nullable();
            $table->string('ration_card_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
        Schema::dropIfExists('diagnoses');
        Schema::dropIfExists('diagnosis_types');
        Schema::dropIfExists('categories');
    }
};
