<?php   

namespace App\Interfaces\Sections;   

interface SectionRepositoryInterface{     
    public function index();
    public function show($id);
    public function store($requset);
    public function update($requset);
    public function delete($requset);
}