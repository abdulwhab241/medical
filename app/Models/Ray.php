<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Insurance;
use App\Models\RayEmployee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ray extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function Insurance()
    {
        return $this->belongsTo(Insurance::class,'invoice_id');
    }

    public function employee()
    {
        return $this->belongsTo(RayEmployee::class,'employee_id')
            ->withDefault(['name'=>'noEmployee']);
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
}
