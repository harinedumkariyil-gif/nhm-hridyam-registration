<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $guarded = [];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function diagnosisType()
    {
        return $this->belongsTo(DiagnosisType::class);
    }
}
