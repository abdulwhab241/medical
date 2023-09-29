<?php

namespace App\Livewire\Chat;

use App\Models\User;
use App\Models\Message;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class Createchat extends Component
{
    public $users;
    public $auth_name;

    public function mount()
    {
        $this->auth_name = auth()->user()->name;
    }

    public function createConversation($receiver_name)
    {

        $chek_Conversation = Conversation::chekConversation($this->auth_name, $receiver_name)->get();
        if ($chek_Conversation->isEmpty()) {
            // DB::beginTransaction();
            try {
                // $createConversation
                $createConversation = Conversation::create([
                    'sender_name' => $this->auth_name,
                    'receiver_name' => $receiver_name,
                    'last_time_message' => null,
                ]);
                // create message
                Message::create([
                    'conversation_id' => $createConversation->id,
                    'sender_name' => $this->auth_name,
                    'receiver_name' => $receiver_name,
                    'body' => 'السلام عليكم',
                ]);
                // DB::commit();
                $this->emitSelf('render');
            } catch (\Exception $e) {
                // DB::rollBack();
            }
        } else {

            dd('Conversation yes');
        }

    }

    public function render()
    {
        if (Auth::guard('patient')->check()) {
            $this->users = User::where('disc','دكتور')->get();
        } else {
            $this->users = Patient::all();
        }
        return view('livewire.chat.createchat')->extends('Dashboard.layouts.master');
    }
    // public function render()
    // {
    //     return view('livewire.chat.createchat');
    // }
}
