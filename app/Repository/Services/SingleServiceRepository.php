<?php

namespace App\Repository\Services;

use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Models\Service;
use App\Traits\UploadTrait;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;

class SingleServiceRepository implements SingleServiceRepositoryInterface{
  
 use UploadTrait;

 //============== Single Service Page ==================
 public function index(){
  $services = Service::all();
  return view('Dashboard.Services.SingleService.index', compact('services'));
}

//============== Add Service Page ==================
public function create(){
 return "create"; 
}

//============== Create Service Info ==================
 public function store($request){
  try{
    DB::beginTransaction();
    $singleService = new Service();
    $singleService->price = $request->price;
    $singleService->description = $request->description;
    $singleService->status = 1;
    $singleService->save();
    
    $singleService->name = $request->name;
    $singleService->save();
    
    DB::commit();
    Session()->flash('add');
    return redirect()->route('Services.index');
  }
  catch (\Exception $e){
    DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }
 }

//============== Show Service Page ==================
 public function show($id){
  return Service::findOrFail($id);
}

//============== Update Service Info ==================
 public function update($request){
    $singleService = Service::findOrFail($request->id);
    $singleService->price = $request->price;
    $singleService->description = $request->description;
    $singleService->status = 1;
    $singleService->name = $request->name;
    $singleService->update();
    
    Session()->flash('edit');
    return redirect()->route('Services.index');
 }

//============== Delete Service ==================
 public function delete($id){
  Service::destroy($id);
  
  Session()->flash('delete');
  return redirect()->route('Services.index');
}
}