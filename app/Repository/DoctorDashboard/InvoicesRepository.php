<?php

namespace App\Repository\DoctorDashboard;

use App\Interfaces\DoctorDashboard\InvoicesRepositoryInterface;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class InvoicesRepository implements InvoicesRepositoryInterface{
  
  public function index($status){
    $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', $status)->get();
    return view('Dashboard.Doctor.Invoices.index', compact('invoices', 'status'));
  }
  
  public function show($id){
    $rays = Ray::where('id', $id)->where('doctor_id', Auth::user()->id)->where('case', 1)->first();
    if($rays){
      return view('Dashboard.Doctor.Invoices.view_rays', compact('rays'));
    }else{
      return redirect()->route('404');
    }
  }
  
  public function viewLaboratories($id){
    $laboratories = Laboratorie::where('id', $id)->where('doctor_id', Auth::user()->id)->where('case', 1)->first();
    if($laboratories){
      return view('Dashboard.Doctor.Invoices.view_laboratories', compact('laboratories'));
    }else{
      return redirect()->route('404');
    }
  }
}