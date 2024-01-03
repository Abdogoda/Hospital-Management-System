<?php

namespace App\Repository\Patients;

use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Models\Section;
use App\Models\SingleInvoice;
use App\Traits\UploadTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientRepositoryInterface{
  
  use UploadTrait;

  //============== patient Patients Page ==================
  public function index(){
   $patients = Patient::all();
   return view('Dashboard.Patients.index', compact('patients'));
 }
 
 //============== Add Patients Page ==================
 public function create(){
   return view('Dashboard.Patients.add'); 
 }
 
 //============== Create Patients Info ==================
  public function store($request){
   try{
     $patient = new Patient();
     $patient->email = $request->email;
     $patient->phone = $request->phone;
     $patient->gender = $request->gender;
     $patient->password = $request->phone;
     $patient->date_of_birth = $request->date_of_birth;
     $patient->blood_type = $request->blood_type;
     $patient->save();
 
     $patient->name = $request->name;
     $patient->address = $request->address;
     $patient->save();
     Session()->flash('add');
     return redirect()->route('Patients.index');
   }
   catch (\Exception $e){
     DB::rollback();
     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }
  }
 
 //============== Show Patients Page ==================
  public function show($id){
   $patient = patient::findOrFail($id);
   $invoices = Invoice::where('patient_id', $id)->get();
   $receipt_accounts = ReceiptAccount::where('patient_id', $patient->id)->get();
   $patient_accounts = PatientAccount::where('patient_id', $patient->id)->get();
   return view('Dashboard.Patients.show', compact('patient', 'invoices', 'patient_accounts', 'receipt_accounts')); 
 }
 
 //============== Edit Patients Page ==================
  public function edit($id){
   $patient = Patient::findOrFail($id);
   return view('Dashboard.Patients.edit', compact('patient')); 
 }
 
 //============== Update Patients Info ==================
  public function update($request){
   $patient = Patient::findOrFail($request->id);
  //  $patient->update($request->all());
   $patient->email = $request->email;
   $patient->phone = $request->phone;
   $patient->gender = $request->gender;
   $patient->password = $request->phone;
   $patient->date_of_birth = $request->date_of_birth;
   $patient->blood_type = $request->blood_type;
   $patient->name = $request->name;
   $patient->address = $request->address;
   $patient->update();
   Session()->flash('edit');
   return redirect()->route('Patients.index');
  }
 
 //============== Delete Patients ==================
  public function delete($id){
    Patient::destroy($id);
   Session()->flash('delete');
   return redirect()->route('Patients.index');
 }
 }