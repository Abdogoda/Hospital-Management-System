<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message, $invoice_id, $patient, $date;
    public function __construct($data){
        $patient = Patient::findOrFail($data['patient_id']);
        $this->message = $data['message'];
        $this->patient = $patient->name;
        $this->invoice_id = $data['invoice_id'];
        $this->date = $data['date'];
    }

    public function broadcastOn(): array{
        return ['my-channel'];
    }
}