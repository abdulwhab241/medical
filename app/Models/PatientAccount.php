<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PaymentAccount;
use App\Models\ReceiptAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientAccount extends Model
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

    public function Receipt()
    {
        return $this->belongsTo(ReceiptAccount::class,'receipt_id');
    }

    public function Payment()
    {
        return $this->belongsTo(PaymentAccount::class,'payment_id');
    }
}
