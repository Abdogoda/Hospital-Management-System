<?php   

namespace App\Interfaces\Doctors;   

interface DoctorRepositoryInterface{     
    public function index();
    public function create();
    public function store($requset);
    public function changeStatus($requset);
    public function changePassword($requset);
    public function edit($id);
    public function update($requset, $id);
    public function delete($requset);
}