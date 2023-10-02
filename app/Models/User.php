<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use App\Models\Section;
use App\Models\Image;
use App\Models\Appointment;
use App\Models\AppointmentDoctor;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'job',
        'day',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $casts = [
    //     'image' => 'array',
    // ];

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id')
            ->withDefault(['name'=>'noEmployee']);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    // public function section()
    // {
    //     return $this->belongsTo(Section::class,'section_id');
    // }
}
