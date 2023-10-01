<?php

namespace App\Models;

use App\Models\Insurance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InsuranceDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    public function Insurance()
    {
        return $this->belongsTo(Insurance::class,'insurance_id');
    }
}
