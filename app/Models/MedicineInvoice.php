<?php

namespace App\Models;

use App\Models\User;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Diagnostic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicineInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class,'user_doctor_id');
    }

    public function Diagnostic()
    {
        return $this->belongsTo(Diagnostic::class,'diagnostic_id');
    }

    public function Medicine()
    {
        return $this->belongsTo(Medicine::class,'medicine_id');
    }
}
