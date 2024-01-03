<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Appointments extends Controller{
    public function index(){
        $appointments = Appointment::where('type', 'غير مؤكد')->get();
        return view('Dashboard.Appointments.index', compact('appointments'));
    }
    public function completed(){
        $appointments = Appointment::where('type', 'منتهي')->get();
        return view('Dashboard.Appointments.index2', compact('appointments'));
    }
    public function approved(){
        $appointments = Appointment::where('type',  'مؤكد')->get();
        return view('Dashboard.Appointments.index2', compact('appointments'));
    }
    public function approval(Request $request, $id){
        $appointment = Appointment::find($id);
        $appointment->date = $request->date;
        $appointment->type = 'مؤكد';
        $appointment->save();
        Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment->name,$appointment->date));
        session()->flash('add');
        return redirect()->back();
    }
}