<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\LaboratoryEmployee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laboratory extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function employee()
    {
        return $this->belongsTo(LaboratoryEmployee::class,'employee_id')
            ->withDefault(['name'=>'noEmployee']);
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}