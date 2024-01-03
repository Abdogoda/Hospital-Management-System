<?php

namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use App\Traits\UploadTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface{
  
 use UploadTrait;

 //============== Home Doctor Page ==================
 public function index(){
  $doctors = Doctor::all();
  $sections = Section::all();
  $appointments = Appointment::all();
  return view("Dashboard.Doctors.index", compact("doctors",'appointments'));
}

//============== Add Doctor Page ==================
public function create(){
  $sections = Section::all();
  $appointments = Appointment::all();
  return view("Dashboard.Doctors.add",compact('sections','appointments'));  
}

//============== Create Doctor Info ==================
 public function store($request){
  DB::beginTransaction();
  $doctor = new Doctor();
   $doctor->email = $request->email;
   $doctor->password = Hash::make($request->password);
   $doctor->phone = $request->phone;
   $doctor->section_id = $request->section_id;
   $doctor->status = $request->status;
   $doctor->appointments = implode(',', $request->appointments);
   $doctor->save();
   
   // Store Trans
   $doctor->name = $request->name;
   $doctor->save();

   // Upload image
   $this->verifyAndStoreImage($request, 'image', 'doctors', 'uploaded_files', $doctor->id, 'App\Models\Doctor');

   DB::commit();
   Session()->flash('add');
   return redirect()->route('Doctors.create');
 }

//============== Edit Doctor Page ==================
 public function edit($id){
  $doctor = Doctor::findOrFail($id);
  $sections = Section::all();
  $appointments = Appointment::all();
  return view("Dashboard.Doctors.edit",compact('doctor','sections','appointments'));
}

//============== Update Doctor Info ==================
 public function update($request, $id){
  try{
    $doctor = Doctor::findOrFail($request->id);
    $doctor->update([
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'section_id' => $request->section_id,
    'status' => $request->status,
    'appointments' => implode(',', $request->appointments)
    ]);
    if($request->image != null){
      if($doctor->image){
        $this->delete_attachments('uploaded_files', 'doctors/'.$doctor->image->filename, $request->id, $doctor->image->filename);
      }
      $this->verifyAndStoreImage($request, 'image', 'doctors', 'uploaded_files', $doctor->id, 'App\Models\Doctor');
    }
    Session()->flash('edit');
    return redirect()->route('Doctors.index');
  }catch(Exception $e){
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }
 }

//============== Change Doctor Status ==================
public function changeStatus($request){
  try{
    $doctor = Doctor::findOrFail($request->id);
    $status = 1;
    if($doctor->status == 1){
      $status = 0;
    }
    $doctor->update([
      'status' => $status
    ]);
    Session()->flash('edit');
    return redirect()->route('Doctors.index');
  }catch(Exception $e){
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }
}

//============== Change Doctor Password ==================
public function changePassword($request){
  try{
    if (Hash::check($request->old_password, Doctor::find($request->id)->password)) {
      $doctor = Doctor::findOrFail($request->id);
      $doctor->update([
        'password' => Hash::make($request->password)
      ]);
      Session()->flash('edit');
      return redirect()->back();
    }else{
      Session()->flash('old_password_wrong');
      return redirect()->back();
    }
  }catch(Exception $e){
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }
}

//============== Delete Doctor ==================
 public function delete($request){
  try{
    if($request->one_multi == "one"){
      $doctor = Doctor::findOrFail($request->id);
      if($doctor->image){
        $this->delete_attachments('uploaded_files', 'doctors/'.$doctor->image->filename, $request->id, $doctor->image->filename);
      }
      $doctor->delete();
    }else{
      foreach(explode(',', $request->delete_select_id) as $doctor_id){
        $doctor = Doctor::findOrFail($doctor_id);
        if($doctor->image){
          $this->delete_attachments('uploaded_files', 'doctors/'.$doctor->image->filename, $doctor_id, $doctor->image->filename);
        }
        $doctor->delete();
      }
    }
    Session()->flash('delete');
    return redirect()->route('Doctors.index');
  }catch(Exception $e){
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }
 }
}