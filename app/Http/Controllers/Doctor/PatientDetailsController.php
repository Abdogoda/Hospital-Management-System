<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\Laboratorie;
use App\Models\Patient;
use App\Models\Ray;
use Illuminate\Http\Request;

class PatientDetailsController extends Controller{
    //

    public function index($id){
        $patient_records = Diagnostic::where('patient_id', $id)->get();
        $patient_rays= Ray::where('patient_id', $id)->get();
        $patient_labs= Laboratorie::where('patient_id', $id)->get();
        $patient = Patient::findOrFail($id);
        return view('Dashboard.Doctor.Invoices.patient_details', compact('patient', 'patient_records', 'patient_rays','patient_labs'));
    }
}