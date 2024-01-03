<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\Service;
use Livewire\Component;

class GroupServices extends Component{
    public $GroupsItems = [];
    public $allServices = [];
    public $discount_value = 0;
    public $taxes = 17;
    public $name_group;
    public $notes;
    public $ServiceSaved = false;
    public $ServiceUpdated = false;
    public $show_table = true; 
    // public $show_table = false; // For Test Only
    public $updateMode = false;
    public $group_id;

    public function __construct(){
        $this->allServices = Service::all();
    }
    public function mount(){
        $this->allServices = Service::all();
    }

    public function render(){
        $total = 0;
        foreach ($this->GroupsItems as $groupItem) {
            if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                $total += $groupItem['service_price'] * $groupItem['quantity'];
            }
        }
        return view('livewire.GroupServices.group-services', [
            'groups'=>Group::all(),
            'subtotal' => $Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'total' => $Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100)
        ]);
    }

    public function addService(){
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('GroupsItems.' . $key, 'يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.');
                return;
            }
        }

        $this->GroupsItems[] = [
            'service_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'service_name' => '',
            'service_price' => 0
        ];
        $this->ServiceSaved = false;
    }

    public function editService($index){
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('GroupsItems.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }
        $this->GroupsItems[$index]['is_saved'] = false;
    }

    public function saveService($index){
        // $this->resetErrorBag();
        $product = $this->allServices->find($this->GroupsItems[$index]['service_id']);
        $this->GroupsItems[$index]['service_name'] = $product->name;
        $this->GroupsItems[$index]['service_price'] = $product->price;
        $this->GroupsItems[$index]['is_saved'] = true;
    }

    public function removeService($index){
        unset($this->GroupsItems[$index]);
        $this->GroupsItems = array_values($this->GroupsItems);
    }

    public function saveGroup(){
        // update
        if($this->updateMode){
            $Groups = Group::find($this->group_id);
            $total = 0;
            foreach ($this->GroupsItems as $groupItem) {
                if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                    // الاجمالي قبل الخصم
                    $total += $groupItem['service_price'] * $groupItem['quantity'];
                }
            }
            $Groups->total_before_discount = $total;
            $Groups->discount_value = $this->discount_value;
            $Groups->total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
            $Groups->tax_rate = $this->taxes;
            $Groups->total_with_tax = $Groups->total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
            $Groups->save();

            $Groups->name=$this->name_group;
            $Groups->notes=$this->notes;
            $Groups->save();

            $Groups->service_group()->detach();
            foreach ($this->GroupsItems as $GroupsItem) {
                $Groups->service_group()->attach($GroupsItem['service_id'],['quantity' => $GroupsItem['quantity']]);
            }
            $this->ServiceSaved = false;
            $this->ServiceUpdated = true;
        }
        else{
            // insert
            $Groups = new Group();
            $total = 0;
            foreach ($this->GroupsItems as $groupItem) {
                if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                    // الاجمالي قبل الخصم
                    $total += $groupItem['service_price'] * $groupItem['quantity'];
                }
            }
            $Groups->Total_before_discount = $total;
            $Groups->discount_value = $this->discount_value;
            $Groups->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
            $Groups->tax_rate = $this->taxes;
            $Groups->Total_with_tax = $Groups->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
            $Groups->save();

            $Groups->name=  $this->name_group;
            $Groups->notes= $this->notes;

            foreach ($this->GroupsItems as $GroupsItem) {
                $Groups->service_group()->attach($GroupsItem['service_id'],['quantity' => $GroupsItem['quantity']]);
            }
            $this->reset('GroupsItems', 'name_group', 'notes');
            $this->discount_value = 0;
            $this->ServiceSaved = true;
        }
    }

    public function show_form_add(){
        $this->show_table = false;
    }

    public function edit($id){
        $this->show_table = false;
        $this->updateMode = true;
        $group = Group::where('id',$id)->first();
        $this->group_id = $id;

        $this->reset('GroupsItems', 'name_group', 'notes');
        $this->name_group=$group->name;
        $this->notes=$group->notes;

        $this->discount_value = intval($group->discount_value);
        $this->ServiceSaved = false;
        foreach ($group->service_group as $serviceGroup){
            $this->GroupsItems[] = [
                'service_id' => $serviceGroup->id,
                'quantity' => $serviceGroup->pivot->quantity,
                'is_saved' => true,
                'service_name' => $serviceGroup->name,
                'service_price' => $serviceGroup->price
            ];
        }
    }

    public function delete($id){
        Group::destroy($id);
        return redirect()->to('/Add_GroupServices');
    }
}