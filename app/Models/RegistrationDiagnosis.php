<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationDiagnosis extends Model
{
    protected $guarded = [];

    public function diagnosisType()
    {
        return $this->belongsTo(DiagnosisType::class);
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
