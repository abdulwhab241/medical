<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnostic extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
}