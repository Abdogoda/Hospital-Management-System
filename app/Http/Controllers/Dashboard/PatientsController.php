<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Interfaces\Patients\PatientRepositoryInterface;

class PatientsController extends Controller{
    private $patients;
    public function __construct(PatientRepositoryInterface $patients){
        $this->patients = $patients;
    }

    public function index(){
        return $this->patients->index();
    }

    public function create(){
        return $this->patients->create();
    }

    public function store(StorePatientRequest $request){
        return $this->patients->store($request);
    }

    public function show(string $id){
        return $this->patients->show($id);
    }

    public function edit(string $id){
        return $this->patients->edit($id);
    }

    public function update(StorePatientRequest $request){
        return $this->patients->update($request);
    }

    public function destroy(string $id){
        return $this->patients->delete($id);
    }
}