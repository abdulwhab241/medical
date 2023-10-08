<?php

namespace App\Models;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Medicine;
use App\Models\InsuranceInvoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnostic extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];
    
    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }

    public function Doctor()
    {
        return $this->belongsTo(User::class,'user_doctor_id');
    }

    public function Medicine()
    {
        return $this->belongsTo(Medicine::class,'medicine_id')
        ->withDefault(['name'=>'noEmployee']);
    }

    public function Service()
    {
        return $this->belongsTo(Service::class,'service_id')
        ->withDefault(['name'=>'noEmployee']);
    }

    public function InsuranceInvoice()
    {
        return $this->belongsTo(InsuranceInvoice::class,'insurance_invoice_id')
        ->withDefault(['name'=>'noEmployee']);
    }

}
