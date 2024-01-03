<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSingleServiceRequest;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use Illuminate\Http\Request;

class SingleServiceController extends Controller{
    private $services;
    public function __construct(SingleServiceRepositoryInterface $services){
        $this->services = $services;
    }

    public function index(){
        return $this->services->index();
    }

    public function store(StoreSingleServiceRequest $request){
        return $this->services->store($request);
    }

    public function show(string $id){
        return $this->services->show($id);
    }

    public function update(StoreSingleServiceRequest $request){
        return $this->services->update($request);
    }

    public function destroy(string $id){
        return $this->services->delete($id);
    }
}