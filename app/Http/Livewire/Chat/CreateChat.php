<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateChat extends Component{

    public $sender, $receiver, $users;


    public function mount(){
        $this->sender = Auth::user();
    }

    public function createConversation($id){
        DB::beginTransaction();
        if(Auth::guard('patient')->check()){
            $this->receiver = Doctor::findOrFail($id);
        }else{
            $this->receiver = Patient::findOrFail($id);
        }
        // Create Conversation
        $conversation = Conversation::where('sender_email', $this->sender->email)->where('receiver_email', $this->receiver->email)->orwhere('receiver_email', $this->sender->email)->where('sender_email', $this->receiver->email)->first();
        if($conversation){
            $conversation->last_time_message = date("Y-m-d H:i:s");
            $conversation->save();
        }else{
            $conversation = new Conversation();
            $conversation->sender_email = $this->sender->email;
            $conversation->receiver_email = $this->receiver->email;
            $conversation->save();
        }
        // Create Message
        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->sender_email = $this->sender->email;
        $message->receiver_email = $this->receiver->email;
        $message->body = 'Start Conversation';
        $message->save();
        DB::commit();
    }

    public function render(){
        if(Auth::guard('patient')->check()){
            $this->users = Doctor::all();
        }else{
            $this->users = Patient::all();
        }
        return view('livewire.chat.create-chat')->extends("Dashboard.layouts.master");
    }
}