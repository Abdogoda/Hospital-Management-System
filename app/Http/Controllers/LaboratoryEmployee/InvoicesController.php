<?php

namespace App\Http\Controllers\LaboratoryEmployee;

use App\Http\Controllers\Controller;
use App\Interfaces\LaboratoryEmployeeDashboard\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoicesController extends Controller{
    public $invoices;
    public function __construct(InvoicesRepositoryInterface $invoices){
        $this->invoices = $invoices;
    }
    
    public function index(){
        return $this->invoices->index(0);
    }
    public function completed(){
        return $this->invoices->index(1);
    }
    public function show($id){
        return $this->invoices->show($id);
    }
    public function edit($id){
        return $this->invoices->edit($id);
    }
    public function update(Request $request, $id){
        return $this->invoices->update($request, $id);
    }
    public function destory($id){
        return $this->invoices->destroy($id);
    }
}