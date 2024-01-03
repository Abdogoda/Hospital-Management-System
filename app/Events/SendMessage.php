<?php

namespace App\Events;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendMessage implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender, $receiver, $message, $conversation;

    public function __construct($sender_id, $receiver_id, Message $message, Conversation $conversation){
        if(Auth::guard('doctor')->check()){
            $sender = Doctor::find($sender_id);
            $receiver = Patient::find($receiver_id);
        }else{
            $sender = Patient::find($sender_id);
            $receiver = Doctor::find($receiver_id);
        }
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->message = $message;
        $this->conversation = $conversation;
    }

    public function broadcastWith(){
        return [
            'sender_email' => $this->sender->email,
            'receiver_email' => $this->receiver->email,
            'message' => $this->message->id,
            'conversation' => $this->conversation->id,
        ];
    }

    public function broadcastOn(){
        return [
            new PrivateChannel('chat.' . $this->receiver->id),
        ];
    }
}