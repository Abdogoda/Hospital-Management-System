<?php   

namespace App\Interfaces\PatientDashboard;   

interface InvoicesRepositoryInterface{     
    public function index();
    public function viewLaboratories();
    public function viewRay();
    public function ShowPatientLaboratory($id);
    public function ShowPatientRay($id);
    public function viewPayments();
    public function viewReceipts();
}