<?php

namespace App\Repository\LaboratoryEmployeeDashboard;

use App\Interfaces\LaboratoryEmployeeDashboard\InvoicesRepositoryInterface;
use App\Models\Laboratorie;
use App\Models\Laboratory;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesRepository implements InvoicesRepositoryInterface{

  use UploadTrait;
  
  public function index($case){
    if($case == 1){
      $invoices = Laboratorie::where('case', $case)->where('employee_id', Auth::user()->id)->get();
    }else{
      $invoices = Laboratorie::where('case', $case)->get();
    }
    return view('Dashboard.LaboratoryEmployee.Invoices.index', compact('invoices', 'case'));
  }

  public function show($id){
    $laboratories = Laboratorie::where('id', $id)->where('employee_id', Auth::user()->id)->where('case', 1)->first();
    if($laboratories){
      return view('Dashboard.LaboratoryEmployee.Invoices.patient_details', compact('laboratories'));
    }else{
      return redirect()->route('404');
    }
  }

  public function edit($id){
    $invoice = Laboratorie::findOrFail($id);
    return view('Dashboard.LaboratoryEmployee.Invoices.add_diagnosis', compact('invoice'));
  }
  public function update($request, $id){
    DB::beginTransaction();
    try{
      $invoice = Laboratorie::findOrFail($id);
      $invoice->description_employee = $request->description_employee;
      $invoice->employee_id = Auth::user()->id;
      $invoice->case = 1;
      $invoice->save();

      if($request->hasFile('photos')){
        foreach($request->photos as $photo){
          $this->verifyAndStoreImageForeach($photo, 'laboratories', 'uploaded_files', $id, 'App\Models\Laboratorie');
        }
      }

      DB::commit();
      session()->flash('edit');
      return redirect()->route('CompletedLaboratoryInvoices');
    }
    catch (\Exception $e){
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
  public function destroy($id){}
}