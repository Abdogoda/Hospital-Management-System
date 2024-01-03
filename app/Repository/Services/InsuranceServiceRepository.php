<?php

namespace App\Repository\Services;

use App\Interfaces\Services\InsuranceServiceRepositoryInterface;
use App\Models\Insurance;
use App\Models\Service;
use App\Traits\UploadTrait;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;

class InsuranceServiceRepository implements InsuranceServiceRepositoryInterface{
  
 use UploadTrait;

 //============== Insurance Service Page ==================
 public function index(){
  $insurances = Insurance::all();
  return view('Dashboard.Services.InsuranceServices.index', compact('insurances'));
}

//============== Add Service Page ==================
public function create(){
  return view('Dashboard.Services.InsuranceServices.add'); 
}

//============== Create Service Info ==================
 public function store($request){
  try{
    $insurance = new Insurance();
    $insurance->insurance_code = $request->insurance_code;
    $insurance->discount_percentage = $request->discount_percentage;
    $insurance->company_rate = $request->company_rate;
    $insurance->status = 1;
    $insurance->save();

    $insurance->name = $request->name;
    $insurance->notes = $request->notes;
    $insurance->save();
    Session()->flash('add');
    return redirect()->route('Insurances.index');
  }
  catch (\Exception $e){
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }
 }

//============== Show Service Page ==================
 public function show($id){
  $insurance = Insurance::findOrFail($id);
  return $insurance; 
}

//============== Edit Service Page ==================
 public function edit($id){
  $insurance = Insurance::findOrFail($id);
  return view('Dashboard.Services.InsuranceServices.edit', compact('insurance')); 
}

//============== Update Service Info ==================
 public function update($request){
  $insurance = Insurance::findOrFail($request->id);
  $insurance->update($request->all());

  // $insurance->name = $request->name;
  // $insurance->notes = $request->notes;
  // $insurance->update();
  Session()->flash('edit');
  return redirect()->route('Insurances.index');
 }

//============== Delete Service ==================
 public function delete($id){
  Insurance::destroy($id);
  Session()->flash('delete');
  return redirect()->route('Insurances.index');
}
}