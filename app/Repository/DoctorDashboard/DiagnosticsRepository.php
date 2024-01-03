<?php

namespace App\Repository\DoctorDashboard;

use App\Interfaces\DoctorDashboard\DiagnosticsRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class DiagnosticsRepository implements DiagnosticsRepositoryInterface{
  
  public function show($id){
    $patient_records = Diagnostic::where('patient_id', $id)->get();
    return view('Dashboard.Doctor.Invoices.patient_record', compact('patient_records'));
  }

  public function store($request){
    DB::beginTransaction();
    try{
      $invoice_status = Invoice::findOrFail($request->invoice_id);
      $invoice_status->update(['invoice_status' => 3]);

      $diagnosis = new Diagnostic();
      $diagnosis->date = date('Y-m-d');
      $diagnosis->diagnosis = $request->diagnosis;
      $diagnosis->medicine = $request->medicine;
      $diagnosis->invoice_id = $request->invoice_id;
      $diagnosis->patient_id = $request->patient_id;
      $diagnosis->doctor_id = $request->doctor_id;
      $diagnosis->save();
      DB::commit();
      session()->flash('add');
      return redirect()->back();
    }
    catch (\Exception $e){
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function add_review($request){
    DB::beginTransaction();
    try{
      $invoice_status = Invoice::findOrFail($request->invoice_id);
      $invoice_status->update(['invoice_status' => 2]);

      $diagnosis = new Diagnostic();
      $diagnosis->date = date('Y-m-d');
      $diagnosis->review_date = $request->review_date;
      $diagnosis->diagnosis = $request->diagnosis;
      $diagnosis->medicine = $request->medicine;
      $diagnosis->invoice_id = $request->invoice_id;
      $diagnosis->patient_id = $request->patient_id;
      $diagnosis->doctor_id = $request->doctor_id;
      $diagnosis->save();
      DB::commit();
      session()->flash('add');
      return redirect()->back();
    }
    catch (\Exception $e){
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}