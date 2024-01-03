<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsuranceServiceRequest;
use App\Interfaces\Services\InsuranceServiceRepositoryInterface;
use Illuminate\Http\Request;

class InsuranceServicesController extends Controller{

    private $insurances;
    public function __construct(InsuranceServiceRepositoryInterface $insurances){
        $this->insurances = $insurances;
    }

    public function index(){
        return $this->insurances->index();
    }

    public function create(){
        return $this->insurances->create();
    }

    public function store(StoreInsuranceServiceRequest $request){
        return $this->insurances->store($request);
    }

    public function show(string $id){
        return $this->insurances->show($id);
    }

    public function edit(string $id){
        return $this->insurances->edit($id);
    }

    public function update(StoreInsuranceServiceRequest $request){
        return $this->insurances->update($request);
    }

    public function destroy(string $id){
        return $this->insurances->delete($id);
    }
}