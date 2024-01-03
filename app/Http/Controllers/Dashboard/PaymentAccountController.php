<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Finances\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller{

    private $payments;
    public function __construct(PaymentRepositoryInterface $payments){
        $this->payments = $payments;
    }

    public function index(){
        return $this->payments->index();
    }

    public function create(){
        return $this->payments->create();
    }

    public function store(Request $request){
        return $this->payments->store($request);
    }

    public function show(string $id){
        return $this->payments->show($id);
    }

    public function edit(string $id){
        return $this->payments->edit($id);
    }

    public function update(Request $request){
        return $this->payments->update($request);
    }

    public function destroy(string $id){
        return $this->payments->delete($id);
    }
}