<?php

use App\Http\Controllers\Doctor\DiagnosticsController;
use App\Http\Controllers\Doctor\InvoicesController;
use App\Http\Controllers\Doctor\LaboratoriesController;
use App\Http\Controllers\Doctor\PatientDetailsController;
use App\Http\Controllers\Doctor\RayController;
use App\Http\Controllers\RayEmployee\InvoicesController as RayEmployeeInvoicesController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
--------------------------------------------------------------------------
| ray_employee Routes
|--------------------------------------------------------------------------
*/


Route::group(
 [
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
 ], function(){ 

  // =============== Dashboard ray_employee ================       
  Route::get('/ray_employee/dashboard', function () {
   return view('Dashboard.RayEmployee.dashboard');
  })->middleware(['auth:ray_employee'])->name('dashboard.ray_employee');
  
Route::middleware('auth:ray_employee')->group(function(){
  Route::prefix('RayEmployee')->group(function () {
   
    // =============== Invoices ================       
    Route::resource("/RayInvoices", RayEmployeeInvoicesController::class);
    Route::get("/CompletedRayInvoices", [RayEmployeeInvoicesController::class, 'completed'])->name('CompletedRayInvoices');

  });
});
require __DIR__.'/auth.php';
 });