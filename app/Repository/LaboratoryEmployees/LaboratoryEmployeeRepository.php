<?php

namespace App\Repository\LaboratoryEmployees;

use App\Interfaces\LaboratoryEmployees\LaboratoryEmployeeRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use App\Models\Laboratory;
use App\Models\LaboratoryEmployee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LaboratoryEmployeeRepository implements LaboratoryEmployeeRepositoryInterface{
  
  public function index(){
    $laboratory_employees = LaboratoryEmployee::all();
    return view('Dashboard.LaboratoryEmployees.index', compact('laboratory_employees'));
  }

  public function store($request){
    DB::beginTransaction();
    try{
      $Laboratory_employee = new LaboratoryEmployee();
      $Laboratory_employee->name = $request->name;
      $Laboratory_employee->email = $request->email;
      $Laboratory_employee->password = Hash::make($request->password);
      $Laboratory_employee->save();
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
      $Laboratory_employee = LaboratoryEmployee::findOrFail($id);
      $Laboratory_employee->name = $request->name;
      $Laboratory_employee->email = $request->email;
      if($request->password){
        $Laboratory_employee->password = Hash::make($request->password);
      }
      $Laboratory_employee->save();
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
      LaboratoryEmployee::destroy($id);
      session()->flash('delete');
      return redirect()->back();
    }
    catch(\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}