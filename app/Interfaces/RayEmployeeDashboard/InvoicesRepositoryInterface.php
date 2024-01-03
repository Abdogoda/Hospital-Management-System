<?php   

namespace App\Interfaces\RayEmployeeDashboard;   

interface InvoicesRepositoryInterface{     
    public function index($case);
    public function show($id);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
}