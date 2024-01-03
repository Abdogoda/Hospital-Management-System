<?php

namespace App\Repository\DoctorDashboard;

use App\Interfaces\DoctorDashboard\LaboratorieRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Ray;
use Illuminate\Support\Facades\DB;

class LaboratorieRepository implements LaboratorieRepositoryInterface{
  
  
  public function store($request){
    DB::beginTransaction();
    try{
      $lab = new Laboratorie();
      $lab->description = $request->description;
      $lab->invoice_id = $request->invoice_id;
      $lab->patient_id = $request->patient_id;
      $lab->doctor_id = $request->doctor_id;
      $lab->save();
      DB::commit();
      session()->flash('add');
      return redirect()->back();
    }
    catch (\Exception $e){
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
  
  public function update($request, $id){
    DB::beginTransaction();
    try{
      $lab = Laboratorie::findOrFail($id);
      $lab->description = $request->description;
      $lab->save();
      DB::commit();
      session()->flash('edit');
      return redirect()->back();
    }
    catch (\Exception $e){
      DB::rollBack();
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function destroy($id){
    try{
      Laboratorie::destroy($id);
      session()->flash('delete');
      return redirect()->back();
    }
    catch(\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}