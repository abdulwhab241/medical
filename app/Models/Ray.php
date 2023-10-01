<?php

namespace App\Models;

use App\Models\User;
use App\Models\Patient;
use App\Models\Insurance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ray extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    public function Insurance()
    {
        return $this->belongsTo(Insurance::class,'invoice_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class,'user_ray_id')
            ->withDefault(['name'=>'noEmployee']);
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(User::class,'user_doctor_id');
    }

    // public function images()
    // {
    //     return $this->morphMany(Image::class, 'imageable');
    // }
}
