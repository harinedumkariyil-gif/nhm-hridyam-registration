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
        Schema::create('registration_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');
            $table->date('diagnosis_date')->nullable();
            $table->foreignId('diagnosis_type_id')->nullable()->constrained('diagnosis_types');
            $table->foreignId('diagnosis_id')->nullable()->constrained('diagnoses');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_diagnoses');
    }
};
