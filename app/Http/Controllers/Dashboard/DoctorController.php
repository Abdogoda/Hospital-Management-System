<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use Illuminate\Http\Request;

class DoctorController extends Controller{

    private $doctors;
    public function __construct(DoctorRepositoryInterface $doctors){
        $this->doctors = $doctors;
    }

    public function index(){
        return $this->doctors->index();
    }

    public function create(){
        return $this->doctors->create();
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:doctors',
            'phone' => 'required|unique:doctors',
            'password' => 'required|min:6',
            'status' => 'required|in:0,1',
            'section_id' => 'required',
            'appointments' => 'required'
          ]);
        return $this->doctors->store($request);
    }
    
    public function edit($id){
        return $this->doctors->edit($id);
    }
    
    public function update(Request $request, int $id){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:doctors,email,'.$request->id,
            'phone' => 'required|unique:doctors,phone,'.$request->id,
            'section_id' => 'required',
            'appointments' => 'required'
          ]);
        return $this->doctors->update($request, $id);
    }

    public function changeStatus(Request $request){
        $request->validate([
            'status' => 'required|in:0,1',
          ]);
        return $this->doctors->changeStatus($request);
    }

    public function changePassword(Request $request){
        $request->validate([
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
          ]);
        return $this->doctors->changePassword($request);
    }

    public function destroy(Request $request){
        return $this->doctors->delete($request);
    }
}