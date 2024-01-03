<?php   

namespace App\Interfaces\DoctorDashboard;   

interface RayRepositoryInterface{
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}