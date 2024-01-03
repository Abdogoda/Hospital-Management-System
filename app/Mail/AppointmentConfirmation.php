<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable{
    use Queueable, SerializesModels;

    public $name, $date;
    public function __construct($name, $date){
        $this->name = $name;
        $this->date = $date;
    }

    public function envelope(): Envelope{
        return new Envelope(
            subject: 'Appointment Confirmation',
        );
    }

    public function content(): Content{
        return new Content(
            markdown: 'emails.appointments',
        );
    }

    public function attachments(): array{
        return [];
    }
}