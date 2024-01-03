<?php

namespace App\Repository\Services;

use App\Interfaces\Services\AmbulanceServiceRepositoryInterface;
use App\Models\Ambulance;
use App\Traits\UploadTrait;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;

class AmbulanceServiceRepository implements AmbulanceServiceRepositoryInterface{
  
 use UploadTrait;

 //============== Ambulance Service Page ==================
 public function index(){
  $ambulances = Ambulance::all();
  return view('Dashboard.Services.AmbulanceServices.index', compact('ambulances'));
}

//============== Add Service Page ==================
public function create(){
  return view('Dashboard.Services.AmbulanceServices.add'); 
}

//============== Create Service Info ==================
 public function store($request){
  try{
    $ambulance = new Ambulance();
    $ambulance->car_number = $request->car_number;
    $ambulance->car_model = $request->car_model;
    $ambulance->car_year_made = $request->car_year_made;
    $ambulance->driver_license_number = $request->driver_license_number;
    $ambulance->driver_phone = $request->driver_phone;
    $ambulance->is_available = 1;
    $ambulance->car_type = 1;
    $ambulance->save();

    $ambulance->driver_name = $request->driver_name;
    $ambulance->notes = $request->notes;
    $ambulance->save();
    Session()->flash('add');
    return redirect()->route('Ambulances.index');
  }
  catch (\Exception $e){
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }
 }

//============== Show Service Page ==================
 public function show($id){
  $ambulance = Ambulance::findOrFail($id);
  return $ambulance; 
}

//============== Edit Service Page ==================
 public function edit($id){
  $ambulance = Ambulance::findOrFail($id);
  return view('Dashboard.Services.AmbulanceServices.edit', compact('ambulance')); 
}

//============== Update Service Info ==================
 public function update($request){
  $ambulance = Ambulance::findOrFail($request->id);    
  $ambulance->car_number = $request->car_number;
  $ambulance->car_model = $request->car_model;
  $ambulance->car_year_made = $request->car_year_made;
  $ambulance->driver_license_number = $request->driver_license_number;
  $ambulance->driver_phone = $request->driver_phone;
  $ambulance->is_available = $request->is_available;
  $ambulance->car_type = $request->car_type;
  $ambulance->driver_name = $request->driver_name;
  $ambulance->notes = $request->notes;
  $ambulance->update();
  Session()->flash('edit');
  return redirect()->route('Ambulances.index');
 }

//============== Delete Service ==================
 public function delete($id){
  Ambulance::destroy($id);
  Session()->flash('delete');
  return redirect()->route('Ambulances.index');
}
}