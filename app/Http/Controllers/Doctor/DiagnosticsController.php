<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\DiagnosticsRepositoryInterface;
use Illuminate\Http\Request;

class DiagnosticsController extends Controller{

    public $diagnosis;
    public function __construct(DiagnosticsRepositoryInterface $diagnosis){
        $this->diagnosis = $diagnosis;
    }
    
    public function show(string $id){
        return $this->diagnosis->show($id);
    }
    
    public function store(Request $request){
        return $this->diagnosis->store($request);
    }

    public function add_review(Request $request){
        return $this->diagnosis->add_review($request);
    }
}