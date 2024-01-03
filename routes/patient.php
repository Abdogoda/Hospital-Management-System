<?php

use App\Http\Controllers\Patient\PatientInvoicesController;
use App\Http\Livewire\Chat\CreateChat;
use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
--------------------------------------------------------------------------
| Doctor Routes
|--------------------------------------------------------------------------
*/


Route::group(
 [
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
 ], function(){ 

  // =============== Dashboard patient ================       
  Route::get('/patient/dashboard', function () {
   return view('Dashboard.Patient.dashboard');
  })->middleware(['auth:patient'])->name('dashboard.patient');
  
Route::middleware('auth:patient')->group(function(){
  Route::prefix('patient')->group(function () {

   
    // =============== Invoices ================       
    Route::resource("/PatientInvoices", PatientInvoicesController::class);
    Route::get("/RayPatientInvoices", [PatientInvoicesController::class, 'viewRay'])->name('RayPatientInvoices');
    Route::get("/LaboratoryPatientInvoices", [PatientInvoicesController::class, 'viewLaboratories'])->name('LaboratoryPatientInvoices');
    Route::get("/ShowPatientRay/{id}", [PatientInvoicesController::class, 'ShowRay'])->name('ShowPatientRay');
    Route::get("/ShowPatientLaboratory/{id}", [PatientInvoicesController::class, 'ShowLaboratory'])->name('ShowPatientLaboratory');
    Route::get("/PatientInvoicesPayments", [PatientInvoicesController::class, 'viewPayments'])->name('PatientInvoicesPayments');
    Route::get("/PatientInvoicesReceipts", [PatientInvoicesController::class, 'viewReceipts'])->name('PatientInvoicesReceipts');

    // =============== Messages ================  
    Route::get('DoctorsList', CreateChat::class)->name('DoctorsList');
    Route::get('LateastMessages', Main::class)->name('LateastMessages');


  });

  Route::get('/404', function(){
    return view('Dashboard.404');
   })->name('404');
});
require __DIR__.'/auth.php';
 });