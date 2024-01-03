<?php

namespace App\Repository\Finances;

use App\Interfaces\Finances\ReceiptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements ReceiptRepositoryInterface{
  
  use UploadTrait;

  //============== Finance Page ==================
  public function index(){
   $receipts = ReceiptAccount::all();
   return view('Dashboard.Finances.Receipts.index', compact('receipts'));
 }
 
 //============== Add Finances Page ==================
 public function create(){
  $Patients = Patient::all();
   return view('Dashboard.Finances.Receipts.add', compact('Patients')); 
 }
 
 //============== Create Finances Info ==================
  public function store($request){
    DB::beginTransaction();

        try{
            // store receipt_accounts
            $receipt_accounts = new ReceiptAccount();
            $receipt_accounts->date = date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->amount = $request->amount;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            
            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date = date('y-m-d');
            $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->debit = $request->amount;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            
            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date = date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_id = $receipt_accounts->id;
            $patient_accounts->debit = 0.00;
            $patient_accounts->credit =$request->amount;
            $patient_accounts->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Receipts.index');
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
  }
 
 //============== Show Finances Page ==================
  public function show($id){
   $receipt = ReceiptAccount::findOrFail($id);
   return view('Dashboard.Finances.Receipts.print', compact('receipt')); 
 }
 
 //============== Edit Finances Page ==================
  public function edit($id){
    $receipt_accounts = ReceiptAccount::findOrFail($id);
    $Patients = Patient::all();
     return view('Dashboard.Finances.Receipts.edit', compact('Patients', 'receipt_accounts')); 
 }
 
 //============== Update Finances Info ==================
  public function update($request){
    DB::beginTransaction();

    try{
        // store receipt_accounts
        $receipt_accounts = ReceiptAccount::findOrFail($request->id);
        $receipt_accounts->date = date('y-m-d');
        $receipt_accounts->patient_id = $request->patient_id;
        $receipt_accounts->amount = $request->amount;
        $receipt_accounts->description = $request->description;
        $receipt_accounts->save();
        
        // store fund_accounts
        $fund_accounts = FundAccount::where('receipt_id', $request->id)->first();
        $fund_accounts->date = date('y-m-d');
        $fund_accounts->receipt_id = $receipt_accounts->id;
        $fund_accounts->debit = $request->amount;
        $fund_accounts->credit = 0.00;
        $fund_accounts->save();
        
        // store patient_accounts
        $patient_accounts = PatientAccount::where('receipt_id', $request->id)->first();
        $patient_accounts->date = date('y-m-d');
        $patient_accounts->patient_id = $request->patient_id;
        $patient_accounts->receipt_id = $receipt_accounts->id;
        $patient_accounts->debit = 0.00;
        $patient_accounts->credit =$request->amount;
        $patient_accounts->save();

        DB::commit();
        session()->flash('edit');
        return redirect()->route('Receipts.index');
    }

    catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
 
 //============== Delete Finances ==================
  public function delete($id){
    try{
      ReceiptAccount::destroy($id);
      Session()->flash('delete');
      return redirect()->route('Receipts.index');
    }
    catch(\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
 }
 }