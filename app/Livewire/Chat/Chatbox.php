<?php

namespace App\Livewire\Chat;

use App\Models\User;
use App\Models\Message;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class Chatbox extends Component
{
    public $receiver;
    public $selected_conversation;
    public $receviverUser;
    public $messages;
    public $auth_name;
    public $auth_id;
    public $event_name;
    public $chat_page;

    //protected $listeners = ['load_conversationDoctor', 'load_conversationPatient', 'pushMessage'];

    public function mount()
    {
        if (Auth::guard('patient')->check()) {
            $this->auth_name = Auth::guard('patient')->user()->name;
            $this->auth_id = Auth::guard('patient')->user()->id;
        } else {
            $this->auth_name = Auth::guard('user')->user()->name;
            $this->auth_id = Auth::guard('user')->user()->id;
        }

    }

    public function getListeners()
    {
        if (Auth::guard('patient')->check()) {
            $auth_id = Auth::guard('patient')->user()->id;
            $this->event_name = "MassageSent2";
            $this->chat_page = "chat2";

        } else {
            $auth_id = Auth::guard('doctor')->user()->id;
            $this->event_name = "MassageSent";
            $this->chat_page = "chat";
        }

        return [
            "echo-private:$this->chat_page.{$auth_id},$this->event_name" => 'broadcastMassage', 'load_conversationPatient', 'load_conversationDoctor', 'pushMessage'
        ];
    }

    public function broadcastMassage($event)
    {
        $broadcastMessage = Message::find($event['message']);
        $broadcastMessage->read = 1;
        $this->pushMessage($broadcastMessage->id);
    }

    public function pushMessage($messageId)
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);
    }


    public function load_conversationDoctor(Conversation $conversation, User $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id', $this->selected_conversation->id)->get();
    }

    public function load_conversationPatient(Conversation $conversation, Patient $receiver)
    {

        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id', $this->selected_conversation->id)->get();
    }


    public function render()
    {
        return view('livewire.chat.chatbox');
    }
    // public function render()
    // {
    //     return view('livewire.chat.chatbox');
    // }
}
