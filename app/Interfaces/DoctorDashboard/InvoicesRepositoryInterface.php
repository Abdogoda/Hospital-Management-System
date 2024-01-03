<?php   

namespace App\Interfaces\DoctorDashboard;   

interface InvoicesRepositoryInterface{     
    public function index($status);
    public function show($id);
    public function viewLaboratories($id);
}