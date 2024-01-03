<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component{
    
    protected $listeners = ['refresh' => '$refresh'];  
    public $conversations, $selected_conversation;
    public $user, $userGuard, $receiver;

    public function mount(){
        $this->user = Auth()->user();
        if(Auth::guard('doctor')->check()){
            $this->userGuard = 'doctor';
        }else{
            $this->userGuard = 'patient';
        }
    }

    public function getOtherUser(Conversation $conversation){
        if($conversation->sender_email == $this->user->email){
            if($this->userGuard == 'doctor'){
                $this->receiver = Patient::where('email', $conversation->receiver_email)->first();
            }else{
                $this->receiver = Doctor::where('email', $conversation->receiver_email)->first();
            }
        }else{
            if($this->userGuard == 'doctor'){
                $this->receiver = Patient::where('email', $conversation->sender_email)->first();
            }else{
                $this->receiver = Doctor::where('email', $conversation->sender_email)->first();
            }
        }
        return $this->receiver;
    }

    public function ChatUserSelect(Conversation $conversation, $receiver_id){
        $this->selected_conversation = $conversation;
        if($this->userGuard == 'doctor'){
            $this->receiver = Patient::findOrFail($receiver_id);
        }else{
            $this->receiver = Doctor::findOrFail($receiver_id);
        }
       $this->emitTo('chat.chat-box', 'load_conversation', $this->selected_conversation, $this->receiver->id);
       $this->emitTo('chat.send-message', 'load_conversation', $this->selected_conversation, $this->receiver->id);
    }

    public function render(){
        $this->conversations = Conversation::where('sender_email', $this->user->email)->orwhere('receiver_email', $this->user->email)->orderBy('last_time_message', 'DESC')->get();
        return view('livewire.chat.chat-list');
    }
}