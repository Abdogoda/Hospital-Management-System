<?php

use App\Http\Controllers\Doctor\DiagnosticsController;
use App\Http\Controllers\Doctor\InvoicesController;
use App\Http\Controllers\Doctor\LaboratoriesController;
use App\Http\Controllers\Doctor\PatientDetailsController;
use App\Http\Controllers\Doctor\LaboratoryController;
use App\Http\Controllers\LaboratoryEmployee\InvoicesController as LaboratoryEmployeeInvoicesController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
--------------------------------------------------------------------------
| laboratory_employee Routes
|--------------------------------------------------------------------------
*/


Route::group(
 [
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
 ], function(){ 

  // =============== Dashboard laboratory_employee ================       
  Route::get('/laboratory_employee/dashboard', function () {
   return view('Dashboard.LaboratoryEmployee.dashboard');
  })->middleware(['auth:laboratory_employee'])->name('dashboard.laboratory_employee');
  
Route::middleware('auth:laboratory_employee')->group(function(){
  Route::prefix('LaboratoryEmployee')->group(function () {
   
    // =============== Invoices ================       
    Route::resource("/LaboratoryInvoices", LaboratoryEmployeeInvoicesController::class);
    Route::get("/CompletedLaboratoryInvoices", [LaboratoryEmployeeInvoicesController::class, 'completed'])->name('CompletedLaboratoryInvoices');

  });
});
require __DIR__.'/auth.php';
 });