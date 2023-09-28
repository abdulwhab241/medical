<?php

namespace App\Models;

use App\Models\User;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    
    public $fillable= ['name','phone','notes','user_doctor_id','section_id','type','appointment'];

    public function doctor()
    {
        return $this->belongsTo(User::class,'user_doctor_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}
