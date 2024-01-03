<?php   

namespace App\Interfaces\DoctorDashboard;   

interface LaboratorieRepositoryInterface{
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}