<?php

namespace App\Repository\Finances;

use App\Interfaces\Finances\PaymentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use App\Models\ReceiptAccount;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface{
  
  use UploadTrait;

  //============== Finance Page ==================
  public function index(){
   $payments = PaymentAccount::all();
   return view('Dashboard.Finances.Payments.index', compact('payments'));
 }
 
 //============== Add Finances Page ==================
 public function create(){
  $Patients = Patient::all();
   return view('Dashboard.Finances.Payments.add', compact('Patients')); 
 }
 
 //============== Create Finances Info ==================
  public function store($request){
    DB::beginTransaction();
        try{
            // store payment_accounts
            $payment_accounts = new PaymentAccount();
            $payment_accounts->date = date('y-m-d');
            $payment_accounts->patient_id = $request->patient_id;
            $payment_accounts->amount = $request->amount;
            $payment_accounts->description = $request->description;
            $payment_accounts->save();
            
            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date = date('y-m-d');
            $fund_accounts->payment_id = $payment_accounts->id;
            $fund_accounts->debit = 0.00;
            $fund_accounts->credit = $request->amount;
            $fund_accounts->save();
            
            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date = date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->payment_id = $payment_accounts->id;
            $patient_accounts->debit = $request->amount;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Payments.index');
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
  }
 
 //============== Show Finances Page ==================
  public function show($id){
   $payment_account = PaymentAccount::findOrFail($id);
   return view('Dashboard.Finances.Payments.print', compact('payment_account')); 
 }
 
 //============== Edit Finances Page ==================
  public function edit($id){
    $payment_accounts = PaymentAccount::findOrFail($id);
    $Patients = Patient::all();
     return view('Dashboard.Finances.Payments.edit', compact('Patients', 'payment_accounts')); 
 }
 
 //============== Update Finances Info ==================
  public function update($request){
    DB::beginTransaction();
    try{
        // store payment_accounts
        $payment_accounts = PaymentAccount::findOrFail($request->id);
        $payment_accounts->date = date('y-m-d');
        $payment_accounts->patient_id = $request->patient_id;
        $payment_accounts->amount = $request->amount;
        $payment_accounts->description = $request->description;
        $payment_accounts->save();
        
        // store fund_accounts
        $fund_accounts = FundAccount::where('payment_id', $request->id)->first();
        $fund_accounts->date = date('y-m-d');
        $fund_accounts->payment_id = $payment_accounts->id;
        $fund_accounts->debit = 0.00;
        $fund_accounts->credit = $request->amount;
        $fund_accounts->save();
        
        // store patient_accounts
        $patient_accounts = PatientAccount::where('payment_id', $request->id)->first();
        $patient_accounts->date = date('y-m-d');
        $patient_accounts->patient_id = $request->patient_id;
        $patient_accounts->payment_id = $payment_accounts->id;
        $patient_accounts->debit = $request->amount;
        $patient_accounts->credit = 0.00;
        $patient_accounts->save();

        DB::commit();
        session()->flash('edit');
        return redirect()->route('Payments.index');
    }
    catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
 
 //============== Delete Finances ==================
  public function delete($id){
    try{
      PaymentAccount::destroy($id);
      Session()->flash('delete');
      return redirect()->route('Payments.index');
    }
    catch(\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
 }
 }