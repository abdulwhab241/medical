<?php

namespace App\Livewire\Chat;

use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class Chatlist extends Component
{
    public $conversations;
    public $auth_name;
    public $receviverUser;
    public $selected_conversation;
    protected $listeners = ['chatUserSelected', 'refresh' => '$refresh'];

    public function mount()
    {
        $this->auth_name = auth()->user()->name;
    }

    public function getUsers(Conversation $conversation, $request)
    {

        if ($conversation->sender_name == $this->auth_name) {
            $this->receviverUser = User::where('disc','دكتور')->firstWhere('name', $conversation->receiver_name);
        } else {
            $this->receviverUser = Patient::firstWhere('name', $conversation->sender_name);
        }
        if (isset($request)) {
            return $this->receviverUser->$request;
        }
    }


    public function chatUserSelected(Conversation $conversation, $receiver_id)
    {

        $this->selected_conversation = $conversation;
        $this->receviverUser = User::find($receiver_id);
        if (Auth::guard('patient')->check()) {
            $this->emitTo('chat.chatbox', 'load_conversationDoctor', $this->selected_conversation, $this->receviverUser);
            $this->emitTo('chat.send-message', 'updateMessage', $this->selected_conversation, $this->receviverUser);
        } else {
            $this->emitTo('chat.chatbox', 'load_conversationPatient', $this->selected_conversation, $this->receviverUser);
            $this->emitTo('chat.send-message', 'updateMessage2', $this->selected_conversation, $this->receviverUser);
        }

    }


    public function render()
    {
        $this->conversations = Conversation::where('sender_name', $this->auth_name)->orWhere('receiver_name', $this->auth_name)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('livewire.chat.chatlist');
    }
    // public function render()
    // {
    //     return view('livewire.chat.chatlist');
    // }
}
