<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateInvoice implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $message, $patient, $date ,$doctor_id;
    public function __construct($data){
        $pa = Patient::find($data['patient']);
        $this->message = $data['message'];
        $this->patient = $pa->name;
        $this->doctor_id = $data['doctor_id'];
        $this->date = $data['date'];
    }
    
    public function broadcastOn(){
        return new PrivateChannel('create-invoice.'.$this->doctor_id);
    }

    public function broadcastAs(){
        return 'create-invoice';
    }
}