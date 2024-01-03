<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\RayRepositoryInterface;
use Illuminate\Http\Request;

class RayController extends Controller{
    public $rays;
    public function __construct(RayRepositoryInterface $rays){
        $this->rays = $rays;
    }

    public function store(Request $request){
        return $this->rays->store($request);
    }

    public function update(Request $request, string $id){
        return $this->rays->update($request, $id);
    }

    public function destroy(string $id){
        return $this->rays->destroy($id);
    }
}