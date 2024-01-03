<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Interfaces\DoctorDashboard\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoicesController extends Controller{
    public $invoices;
    public function __construct(InvoicesRepositoryInterface $invoices){
        $this->invoices = $invoices;
    }
    
    public function index(){
        return $this->invoices->index(1);
    }
    
    public function reviews(){
        return $this->invoices->index(2);
    }
    
    public function completed(){
        return $this->invoices->index(3);
    }
    
    public function show($id){
        return $this->invoices->show($id);
    }
    
    public function viewLaboratories($id){
        return $this->invoices->viewLaboratories($id);
    }
}