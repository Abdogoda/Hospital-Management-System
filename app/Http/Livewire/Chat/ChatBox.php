<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component{

    public $user, $userGuard, $receiver, $selected_conversation;
    public $messages;

    public function mount(){
        if(Auth::guard('doctor')->check()){
            $this->userGuard = 'doctor';
        }else{
            $this->userGuard = 'patient';
        }
        $this->user = Auth::user();
    }

    public function getListeners(){
        return [
            'load_conversation', 
            'pushMessage',
            "echo:private:chat.{$this->user->id},SendMessage" => 'broadcastMessage',
        ];
    }

    public function broadcastMessage($event){
        $message = Message::find($event['message']);
        $message->read = 1;
        $this->pushMessage($message->id);
    }

    public function pushMessage($id){
        $message = Message::find($id);
        $this->messages->push($message);
    }

    public function load_conversation(Conversation $conversation, $receiver_id){
        if($this->userGuard == 'doctor'){
            $this->receiver = Patient::find(intval($receiver_id));
        }else{
            $this->receiver = Doctor::find(intval($receiver_id));
        }
        $this->selected_conversation = $conversation;
        $this->messages = Message::where('conversation_id',$this->selected_conversation->id)->get();
    }

    public function render(){
        return view('livewire.chat.chat-box');
    }
}