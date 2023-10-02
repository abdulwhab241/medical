<?php

namespace App\Models;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];

    // public function doctor()
    // {
    //     return $this->belongsTo(Invoice::class,'doctor_id');
    // }

    // public function service()
    // {
    //     return $this->belongsTo(Invoice::class,'Service_id');
    // }

    public function Gender()
    {
        return $this->belongsTo(Gender::class,'gender_id');
    }
}
