<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RayInvoice extends Model
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
