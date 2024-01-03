<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\RayEmployees\RayEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class RayEmployeesController extends Controller{

    private $ray_employees;
    public function __construct(RayEmployeeRepositoryInterface $ray_employees){
        $this->ray_employees = $ray_employees;
    }

    public function index(){
        return $this->ray_employees->index();
    }

    public function store(Request $request){
        return $this->ray_employees->store($request);
    }

    public function update(Request $request, string $id){
        return $this->ray_employees->update($request, $id);
    }

    public function destroy(string $id){
        return $this->ray_employees->destroy($id);
    }
}