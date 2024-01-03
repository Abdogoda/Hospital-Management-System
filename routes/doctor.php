<?php

use App\Http\Controllers\Doctor\DiagnosticsController;
use App\Http\Controllers\Doctor\InvoicesController;
use App\Http\Controllers\Doctor\LaboratoriesController;
use App\Http\Controllers\Doctor\PatientDetailsController;
use App\Http\Controllers\Doctor\RayController;
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

  // =============== Dashboard Doctor ================       
  Route::get('/doctor/dashboard', function () {
   return view('Dashboard.Doctor.dashboard');
  })->middleware(['auth:doctor'])->name('dashboard.doctor');
  
Route::middleware('auth:doctor')->group(function(){
  Route::prefix('doctor')->group(function () {

    // =============== Invoices ================       
    Route::resource("/Invoices", InvoicesController::class);
    Route::get("/ViewLaboratories/{id}", [InvoicesController::class, 'viewLaboratories'])->name('ViewLaboratories');
    Route::get("/ReviewsInvoices", [InvoicesController::class, 'reviews'])->name('ReviewInvoices');
    Route::get("/CompletedInvoices", [InvoicesController::class, 'completed'])->name('CompletedInvoices');
    
    // =============== Diagnostics ================       
    Route::resource("/Diagnostics", DiagnosticsController::class);
    Route::post("/AddDiagnosticsReview", [DiagnosticsController::class, 'add_review'])->name('AddDiagnosticsReview');

    // =============== Rays ================       
    Route::resource("/Rays", RayController::class);

    // =============== Laboratories ================       
    Route::resource("/Laboratories", LaboratoriesController::class);

    // =============== Patient Details ================       
    Route::get("/PatientDetails/{id}",[PatientDetailsController::class, 'index'])->name('PatientDetails');

      // =============== Messages ================  
      Route::get('PatientsList', CreateChat::class)->name('PatientsList');
      Route::get('LateastPatientMessages', Main::class)->name('LateastPatientMessages');


  });

  Route::get('/404', function(){
    return view('Dashboard.404');
   })->name('404');
});
require __DIR__.'/auth.php';
 });