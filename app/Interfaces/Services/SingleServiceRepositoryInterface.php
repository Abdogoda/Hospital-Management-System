<?php   

namespace App\Interfaces\Services;   

interface SingleServiceRepositoryInterface{     
    public function index();
    public function store($requset);
    public function show($id);
    public function update($requset);
    public function delete($id);
}