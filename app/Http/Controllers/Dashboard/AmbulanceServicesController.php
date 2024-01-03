<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAmbulanceServiceRequest;
use App\Interfaces\Services\AmbulanceServiceRepositoryInterface;
use Illuminate\Http\Request;

class AmbulanceServicesController extends Controller
{
    private $ambulance;
    public function __construct(AmbulanceServiceRepositoryInterface $ambulance){
        $this->ambulance = $ambulance;
    }

    public function index(){
        return $this->ambulance->index();
    }

    public function create(){
        return $this->ambulance->create();
    }

    public function store(StoreAmbulanceServiceRequest $request){
        return $this->ambulance->store($request);
    }

    public function show(string $id){
        return $this->ambulance->show($id);
    }

    public function edit(string $id){
        return $this->ambulance->edit($id);
    }

    public function update(StoreAmbulanceServiceRequest $request){
        return $this->ambulance->update($request);
    }

    public function destroy(string $id){
        return $this->ambulance->delete($id);
    }
}