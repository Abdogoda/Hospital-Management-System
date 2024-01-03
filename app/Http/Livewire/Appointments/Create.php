<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Livewire\Component;

class Create extends Component{

    public $doctor, $section, $name, $email, $phone, $date, $notes;
    public $doctors, $sections;
    public $message = false;

    public function mount(){
        $this->sections = Section::all();
        $this->doctors = [];
    }

    public function updatedSection(){
        $this->doctors = Doctor::where('section_id', $this->section)->get();
    }

    public function store(){
        $appointment = new Appointment();
        $appointment->doctor_id = $this->doctor;
        $appointment->section_id = $this->section;
        $appointment->name = $this->name;
        $appointment->email = $this->email;
        $appointment->phone = $this->phone;
        $appointment->notes = $this->notes;

        $appointment->save();
        $this->message = true;
    }

    public function render(){
        return view('livewire.appointments.create');
    }
}