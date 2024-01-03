<?php

namespace App\Repository\DoctorDashboard;

use App\Interfaces\DoctorDashboard\RayRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use App\Models\Ray;
use Illuminate\Support\Facades\DB;

class RayRepository implements RayRepositoryInterface{
  
  
  public function store($request){
    DB::beginTransaction();
    try{
      $x_ray = new Ray();
      $x_ray->description = $request->description;
      $x_ray->invoice_id = $request->invoice_id;
      $x_ray->patient_id = $request->patient_id;
      $x_ray->doctor_id = $request->doctor_id;
      $x_ray->save();
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
      $x_ray = Ray::findOrFail($id);
      $x_ray->description = $request->description;
      $x_ray->save();
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
      Ray::destroy($id);
      session()->flash('delete');
      return redirect()->back();
    }
    catch(\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}