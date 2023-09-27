<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Patient extends Authenticatable
{
    use HasFactory;
    public $fillable= ['name','address','password','birth_date','phone','gender'];

    public function doctor()
    {
        return $this->belongsTo(Invoice::class,'doctor_id');
    }

    public function service()
    {
        return $this->belongsTo(Invoice::class,'Service_id');
    }
}
