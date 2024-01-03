<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Finances\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptAccountController extends Controller{
    private $receipts;
    public function __construct(ReceiptRepositoryInterface $receipts){
        $this->receipts = $receipts;
    }

    public function index(){
        return $this->receipts->index();
    }

    public function create(){
        return $this->receipts->create();
    }

    public function store(Request $request){
        return $this->receipts->store($request);
    }

    public function show(string $id){
        return $this->receipts->show($id);
    }

    public function edit(string $id){
        return $this->receipts->edit($id);
    }

    public function update(Request $request){
        return $this->receipts->update($request);
    }

    public function destroy(string $id){
        return $this->receipts->delete($id);
    }
}