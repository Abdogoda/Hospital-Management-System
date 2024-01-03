<?php

namespace App\Repository\RayEmployeeDashboard;

use App\Interfaces\RayEmployeeDashboard\InvoicesRepositoryInterface;
use App\Models\Ray;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesRepository implements InvoicesRepositoryInterface{

  use UploadTrait;
  
  public function index($case){
    if($case == 1){
      $invoices = Ray::where('case', $case)->where('employee_id', Auth::user()->id)->get();
    }else{
      $invoices = Ray::where('case', $case)->get();
    }
    return view('Dashboard.RayEmployee.Invoices.index', compact('invoices', 'case'));
  }

  public function show($id){
    $rays = Ray::where('id', $id)->where('employee_id', Auth::user()->id)->where('case', 1)->first();
    if($rays){
      return view('Dashboard.RayEmployee.Invoices.patient_details', compact('rays'));
    }else{
      return redirect()->route('404');
    }
  }

  public function edit($id){
    $invoice = Ray::findOrFail($id);
    return view('Dashboard.RayEmployee.Invoices.add_diagnosis', compact('invoice'));
  }
  public function update($request, $id){
    DB::beginTransaction();
    try{
      $invoice = Ray::findOrFail($id);
      $invoice->description_employee = $request->description_employee;
      $invoice->employee_id = Auth::user()->id;
      $invoice->case = 1;
      $invoice->save();

      if($request->hasFile('photos')){
        foreach($request->photos as $photo){
          $this->verifyAndStoreImageForeach($photo, 'rays', 'uploaded_files', $id, 'App\Models\Ray');
        }
      }

      DB::commit();
      session()->flash('edit');
      return redirect()->route('CompletedRayInvoices');
    }
    catch (\Exception $e){
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
  public function destroy($id){}
}