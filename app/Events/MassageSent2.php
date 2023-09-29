<?php

namespace App\Events;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use App\Models\Conversation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MassageSent2 implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender;
    public $massage;
    public $receiver;
    public $conversation;



    public function __construct(User $sender, Message $massage, Conversation $conversation, Patient $receiver)
    {
        $this->sender = $sender;
        $this->massage = $massage;
        $this->conversation = $conversation;
        $this->receiver = $receiver;
    }
    public function broadcastWith()
    {
        return [
            'sender_name' => $this->sender->name,
            'message' => $this->massage->id,
            'conversation_id' => $this->conversation->id,
            'receivere_name' => $this->receiver->name,
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat2.'.$this->receiver->id);
    }
}
