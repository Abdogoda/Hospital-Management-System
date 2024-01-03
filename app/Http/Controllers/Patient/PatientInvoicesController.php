<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Interfaces\PatientDashboard\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class PatientInvoicesController extends Controller{

      public $invoices;
    public function __construct(InvoicesRepositoryInterface $invoices){
        $this->invoices = $invoices;
    }
    
    public function index(){
        return $this->invoices->index();
    }
    public function viewLaboratories(){
        return $this->invoices->viewLaboratories();
    }
    public function viewRay(){
        return $this->invoices->viewRay();
    }
    public function ShowPatientLaboratory($id){
        return $this->invoices->ShowPatientLaboratory($id);
    }
    public function ShowPatientRay($id){
        return $this->invoices->ShowPatientRay($id);
    }
    public function viewPayments(){
        return $this->invoices->viewPayments();
    }
    public function viewReceipts(){
        return $this->invoices->viewReceipts();
    }
}