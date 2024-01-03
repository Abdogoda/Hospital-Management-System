<?php   

namespace App\Interfaces\LaboratoryEmployeeDashboard;   

interface InvoicesRepositoryInterface{     
    public function index($case);
    public function show($id);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
}