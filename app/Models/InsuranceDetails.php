<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceDetails extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function Insurance()
    {
        return $this->belongsTo(Insurance::class,'insurance_id');
    }
}
