<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function scopeCheckConversation($query,$auth_name,$receiver_name){
        return $query->where('sender_name',$auth_name)
            ->where('receiver_name',$receiver_name)->orWhere('receiver_name',$auth_name)->
            where('sender_name',$receiver_name);
    }

    public function messages(){

    return $this->hasMany(Message::class);
    }
}
