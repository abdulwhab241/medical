<?php

namespace App\Models;

use App\Models\Day;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentDoctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];
    
    public function Doctor()
    {
        return $this->belongsTo(User::class,'user_doctor_id');
    }

    public function Day()
    {
        return $this->belongsTo(Day::class,'day_id');
    }
}
