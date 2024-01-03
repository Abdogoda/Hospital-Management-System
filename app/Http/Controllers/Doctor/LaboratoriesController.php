<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\LaboratorieRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoriesController extends Controller
{
    public $labs;
    public function __construct(LaboratorieRepositoryInterface $labs){
        $this->labs = $labs;
    }

    public function store(Request $request){
        return $this->labs->store($request);
    }

    public function update(Request $request, string $id){
        return $this->labs->update($request, $id);
    }

    public function destroy(string $id){
        return $this->labs->destroy($id);
    }
}