<?php

namespace App\Http\Livewire\Chat;

use App\Events\SendMessage as EventsSendMessage;
use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Livewire\Component;

class SendMessage extends Component{

    protected $listeners = ['load_conversation', 'dispatchSendMessage'];  
    public $body;
    public $user, $userGuard, $receiver, $selected_conversation, $message;

    public function mount(){
        if(Auth::guard('doctor')->check()){
            $this->userGuard = 'doctor';
        }else{
            $this->userGuard = 'patient';
        }
        $this->user = Auth::user();
    }

    public function load_conversation(Conversation $conversation, int $receiver_id){
        $this->selected_conversation = $conversation;
        if($this->userGuard == 'doctor'){
            $this->receiver = Patient::find(intval($receiver_id));
        }else{
            $this->receiver = Doctor::find(intval($receiver_id));
        }
    }

    public function sendMessage(){
        if($this->body != Null){
            $conver = Conversation::findOrFail($this->selected_conversation->id);
            $conver->last_time_message = date('Y-m-d H:i:s');
            $conver->save();
            
            $message = new Message();
            $message->conversation_id = $this->selected_conversation->id;
            $message->sender_email = $this->user->email;
            $message->receiver_email = $this->receiver->email;
            $message->body = $this->body;
            $message->save();
            $this->reset('body');

            $this->message = $message;
            $this->emitTo('chat.chat-box', 'pushMessage', $message->id);
            $this->emitTo('chat.chat-list', 'refresh');
            $this->emitSelf('dispatchSendMessage');
        }else{
            return Null;
        }
    }

    public function dispatchSendMessage(){
        Broadcast(new EventsSendMessage(
            $this->user->id,
            $this->receiver->id,
            $this->message,
            $this->selected_conversation
        ));
    }

    public function render(){
        return view('livewire.chat.send-message');
    }
}