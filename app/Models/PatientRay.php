<?php

namespace App\Models;

use App\Models\User;
use App\Models\Patient;
use App\Models\RayService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientRay extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded=[];

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(User::class,'user_doctor_id');
    }

    public function Ray()
    {
        return $this->belongsTo(RayService::class,'ray_id');
    }
}
