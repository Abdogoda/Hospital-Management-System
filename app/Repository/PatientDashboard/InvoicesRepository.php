<?php

namespace App\Repository\PatientDashboard;

use App\Interfaces\PatientDashboard\InvoicesRepositoryInterface;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Laboratory;
use App\Models\PaymentAccount;
use App\Models\Ray;
use App\Models\ReceiptAccount;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesRepository implements InvoicesRepositoryInterface{

  use UploadTrait;
  
  public function index(){
    $invoices = Invoice::where('patient_id', Auth::user()->id)->get();
    return view('Dashboard.Patient.Invoices.index', compact('invoices'));
  }

  public function viewRay(){
    $rays = Ray::where('patient_id', Auth::user()->id)->get();
    return view('Dashboard.Patient.Invoices.rays', compact('rays'));
  }
  
  public function viewLaboratories(){
    $laboratories = Laboratorie::where('patient_id', Auth::user()->id)->get();
    return view('Dashboard.Patient.Invoices.laboratories', compact('laboratories'));
  }

  public function ShowPatientRay($id){
    $ray = Ray::where('patient_id', Auth::user()->id)->where('id', $id)->first();
    if($ray == Null){
      return redirect()->route('404');
    }else{
      return view('Dashboard.Patient.Invoices.show_ray', compact('ray'));
    }
  }
  
  public function ShowPatientLaboratory($id){
    $laboratory = Laboratorie::where('patient_id', Auth::user()->id)->where('id', $id)->first();
    if($laboratory == Null){
      return redirect()->route('404');
    }else{
      return view('Dashboard.Patient.Invoices.show_laboratory', compact('laboratory'));
    }
  }

  public function viewPayments(){
    $payments = PaymentAccount::where('patient_id', Auth::user()->id)->get();
    return view('Dashboard.Patient.Invoices.payments', compact('payments'));
  }

  public function viewReceipts(){
    $receipts = ReceiptAccount::where('patient_id', Auth::user()->id)->get();
    return view('Dashboard.Patient.Invoices.receipts', compact('receipts'));
  }
}