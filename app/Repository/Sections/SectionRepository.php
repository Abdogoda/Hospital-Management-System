<?php

namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Appointment;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface{

 public function index(){
  $sections = Section::all();
  return view("Dashboard.Sections.index",compact('sections'));  
 }

 public function show($id){
  $doctors = Section::findOrFail($id)->doctors;
  $section = Section::findOrFail($id);
  $appointments = Appointment::all();
  return view("Dashboard.Sections.show",compact('section', 'doctors', 'appointments'));  
 }

 public function store($requset){
  $requset->validate([
   'name' => 'required|min:3|unique',
  ]);
  Section::create([
   'name' => $requset->name,
  ]);
  Session()->flash('add');
  return redirect()->route('Sections.index');
 }
 
 public function update($requset){
  $section = Section::findOrFail($requset->id);
  $section->update([
   'name' => $requset->name,
  ]);
  Session()->flash('edit');
  return redirect()->route('Sections.index');
 }

 public function delete($requset){
  $section = Section::findOrFail($requset->id);
  $section->delete();
  Session()->flash('delete');
  return redirect()->route('Sections.index');
 }
}