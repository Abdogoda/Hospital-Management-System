<?php   

namespace App\Interfaces\Patients;   

interface PatientRepositoryInterface{     
    public function index();
    public function create();
    public function store($requset);
    public function show($id);
    public function edit($id);
    public function update($requset);
    public function delete($id);
}