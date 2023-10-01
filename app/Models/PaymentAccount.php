<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];
    
    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
