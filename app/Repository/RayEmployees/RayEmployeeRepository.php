<?php

namespace App\Repository\RayEmployees;

use App\Interfaces\RayEmployees\RayEmployeeRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use App\Models\Ray;
use App\Models\RayEmployee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface{
  
  public function index(){
    $ray_employees = RayEmployee::all();
    return view('Dashboard.RayEmployees.index', compact('ray_employees'));
  }

  public function store($request){
    DB::beginTransaction();
    try{
      $ray_employee = new RayEmployee();
      $ray_employee->name = $request->name;
      $ray_employee->email = $request->email;
      $ray_employee->password = Hash::make($request->password);
      $ray_employee->save();
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
      $ray_employee = RayEmployee::findOrFail($id);
      $ray_employee->name = $request->name;
      $ray_employee->email = $request->email;
      if($request->password){
        $ray_employee->password = Hash::make($request->password);
      }
      $ray_employee->save();
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
      RayEmployee::destroy($id);
      session()->flash('delete');
      return redirect()->back();
    }
    catch(\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}