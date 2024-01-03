<?php   

namespace App\Interfaces\DoctorDashboard;   

interface DiagnosticsRepositoryInterface{
    public function show($id);
    public function store($request);
    public function add_review($request);
}