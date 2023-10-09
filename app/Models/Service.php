<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable= ['name','price','description','status', 'user_doctor_id'];

    public function Doctor()
    {
        return $this->belongsTo(User::class,'user_doctor_id');
    }
}
