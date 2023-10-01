<?php

namespace App\Models;

use App\Models\User;
use App\Models\Patient;
use App\Models\Section;
use App\Models\Service;
use App\Models\Insurance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InsuranceInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    public function Service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(User::class,'user_doctor_id');
    }

    public function Section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }

    public function Insurance()
    {
        return $this->belongsTo(Insurance::class,'insurance_id');
    }

}
