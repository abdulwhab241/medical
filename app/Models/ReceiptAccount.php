<?php

namespace App\Models;

use App\Models\User;
use App\Models\Doctor;
// use App\Models\Service;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceiptAccount extends Model
{
    use HasFactory;
    
    protected $guarded=[];

    // public function Service()
    // {
    //     return $this->belongsTo(Service::class,'service_id');
    // }

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(User::class,'user_doctor_id');
    }
}
