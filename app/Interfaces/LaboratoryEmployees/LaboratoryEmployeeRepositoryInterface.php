<?php   

namespace App\Interfaces\LaboratoryEmployees;   

interface LaboratoryEmployeeRepositoryInterface{
    public function index();
    public function store($request);
    public function update($request,$id);
    public function destroy($id);
}