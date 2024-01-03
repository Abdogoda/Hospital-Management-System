<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\LaboratoryEmployees\LaboratoryEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryEmployeesController extends Controller{
    
    private $laboratory_employees;
    public function __construct(LaboratoryEmployeeRepositoryInterface $laboratory_employees){
        $this->laboratory_employees = $laboratory_employees;
    }

    public function index(){
        return $this->laboratory_employees->index();
    }

    public function store(Request $request){
        return $this->laboratory_employees->store($request);
    }

    public function update(Request $request, string $id){
        return $this->laboratory_employees->update($request, $id);
    }

    public function destroy(string $id){
        return $this->laboratory_employees->destroy($id);
    }
}