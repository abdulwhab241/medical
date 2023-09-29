<?php

namespace App\Livewire\Chat;

use App\Models\User;
use App\Models\Message;
use App\Models\Patient;
use Livewire\Component;
use App\Events\MassageSent;
use App\Events\MassageSent2;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class SendMessage extends Component
{
    public $body;
    public $selected_conversation;
    public $receviverUser;
    public $auth_name;
    public $sender;
    public $createdMessage;
    protected $listeners = ['updateMessage','dispatchSentMassage','updateMessage2'];

    public function mount()
    {

        if (Auth::guard('patient')->check()) {
            $this->auth_name = Auth::guard('patient')->user()->name;
            $this->sender = Auth::guard('patient')->user();
        } else {
            $this->auth_name = Auth::guard('user')->user()->name;
            $this->sender = Auth::guard('user')->user();
        }
    }

    public function updateMessage(Conversation $conversation, User $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }

    public function updateMessage2(Conversation $conversation, Patient $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }

    public function sendMessage()
    {
        if ($this->body == null) {
            return null;
        }

        $this->createdMessage = Message::create([
            'conversation_id' => $this->selected_conversation->id,
            'sender_name' => $this->auth_name,
            'receiver_name' => $this->receviverUser->name,
            'body' => $this->body,
        ]);
        $this->selected_conversation->last_time_message = $this->createdMessage->created_at;
        $this->selected_conversation->save();
        $this->reset('body');
        $this->emitTo('chat.chatbox', 'pushMessage', $this->createdMessage->id);
        $this->emitTo('chat.chatlist', 'refresh');
        $this->emitSelf('dispatchSentMassage');
    }
    public function dispatchSentMassage()
    {
        if (Auth::guard('patient')->check()) {
            broadcast(new MassageSent(
                $this->sender,
                $this->createdMessage,
                $this->selected_conversation,
                $this->receviverUser
            ));
        }
        else{
            broadcast(new MassageSent2(
                $this->sender,
                $this->createdMessage,
                $this->selected_conversation,
                $this->receviverUser
            ));
        }

    }

    function render()
    {
        return view('livewire.chat.send-message');
    }
    // public function render()
    // {
    //     return view('livewire.chat.send-message');
    // }
}
