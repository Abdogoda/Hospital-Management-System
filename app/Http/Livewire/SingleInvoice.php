<?php

namespace App\Http\Livewire;

use App\Events\CreateInvoice;
use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SingleInvoice extends Component{

    public $InvoiceSaved, $InvoiceUpdated, $InvoiceDeleted;
    public $show_table = true;
    public $tax_rate = 17;
    public $price,$patient_id, $doctor_id, $section_id, $type, $Service_id, $invoice_id;
    public $update_mode = false;
    public $discount_value = 0;
    public $catchError;

    public function render(){
        return view('livewire.SingleInvoices.single-invoices', [
            'single_invoices'=> Invoice::where('invoice_type', 1)->get(),
            'Patients'=> Patient::all(),
            'Doctors'=> Doctor::all(),
            'Services'=> Service::all(),
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value'=> $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ]);
    }

    public function show_form_add(){
        $this->show_table = false;
    }
    public function hide_form_add(){
        $this->show_table = true;
        $this->update_mode = false;
        $this->invoice_id = null;
        $this->patient_id = null;
        $this->doctor_id = null;
        $this->section_id = null;
        $this->Service_id = null;
        $this->price = null;
        $this->discount_value = 0;
        $this->type = null;
    }

    public function get_section(){
        $doctor_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;

    }

    public function get_price(){
        $this->price = Service::where('id', $this->Service_id)->first()->price;
    }

    public function store(){
        try{
            DB::beginTransaction();
            // Store In Invoices Table
            if($this->update_mode){
                $single_invoices = Invoice::findOrFail($this->invoice_id);
            }else{
                $single_invoices = new Invoice();
            }
            $single_invoices->invoice_type = 1;
            $single_invoices->invoice_date = date('Y-m-d');
            $single_invoices->patient_id = $this->patient_id;
            $single_invoices->doctor_id = $this->doctor_id;
            $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
            $single_invoices->service_id = $this->Service_id;
            $single_invoices->price = $this->price;
            $single_invoices->discount_value = $this->discount_value;
            $single_invoices->tax_rate = $this->tax_rate;
            $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
            $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
            $single_invoices->type = $this->type;
            $single_invoices->save();

            if($this->type == 1){
                // Store In FundAccount Table
                if($this->update_mode){
                    $fund_accounts = FundAccount::where('invoice_id', $this->invoice_id)->first();
                }else{
                    $fund_accounts = new FundAccount();
                }
                $fund_accounts->date = date('Y-m-d');
                $fund_accounts->invoice_id = $single_invoices->id;
                $fund_accounts->debit = $single_invoices->total_with_tax;
                $fund_accounts->credit = 0.00;
                $fund_accounts->save();
            }else if($this->type == 2){
                // Store In Patient Account Table
                if($this->update_mode){
                    $patient_accounts = PatientAccount::where('invoice_id', $this->invoice_id)->first();
                }else{
                    $patient_accounts = new PatientAccount();
                }
                $patient_accounts->date = date('Y-m-d');
                $patient_accounts->invoice_id = $single_invoices->id;
                $patient_accounts->patient_id = $single_invoices->patient_id;
                $patient_accounts->debit = $single_invoices->total_with_tax;
                $patient_accounts->credit = 0.00;
                $patient_accounts->save();
            }
            DB::commit();
            if($this->update_mode){
                $this->InvoiceUpdated = true;
            }else{
                $this->InvoiceSaved = true;

                // Add Notification
                $patient = Patient::findOrFail($this->patient_id);
                $notification = new Notification();
                $notification->user_id = $this->doctor_id;
                $notification->message = "تم اضافة كشف جديد للمريض $patient->name, رقم الكشف $single_invoices->id";
                $notification->url = "/admin/Patients/$this->patient_id";
                $notification->save();

                // Push Notification
                $data = [
                    'message' => $notification->message,
                    'doctor_id' => $this->doctor_id,
                    'patient' => $this->patient_id,
                    'date' => $single_invoices->invoice_date,
                ];
                event(new CreateInvoice($data));
            }
            $this->hide_form_add();
        }
        catch(\Exception $e){
            DB::rollBack();
            $this->catchError = $e->getMessage();
        }
    }

    public function edit($id){
        $this->show_form_add();
        $this->update_mode = true;
        $single_invoice = Invoice::findOrFail($id);
        $this->invoice_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_id = $single_invoice->doctor_id;
        $this->section_id = DB::table('section_translations')->where('id', $single_invoice->section_id)->first()->name;
        $this->Service_id = $single_invoice->service_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;
    }

    public function delete($id){
        $this->invoice_id = $id;
    }

    public function destroy(){
        Invoice::destroy($this->invoice_id);
        $this->InvoiceDeleted = true;
        return redirect()->to('/SingleInvoices');
    }

    public function print($id){
        $single_invoice = Invoice::findOrFail($id);
        return Redirect::route('PrintInvoice', [
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->Doctor->name,
            'section_id' => $single_invoice->Section->name,
            'service_od' => $single_invoice->Service->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);
    }
}