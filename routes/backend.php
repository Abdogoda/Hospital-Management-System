<?php

use App\Events\MyEvent;
use App\Http\Controllers\Dashboard\AmbulanceServicesController;
use App\Http\Controllers\Dashboard\Appointments;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceServicesController;
use App\Http\Controllers\Dashboard\LaboratoryEmployeesController;
use App\Http\Controllers\Dashboard\PatientsController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\RayEmployeesController;
use App\Http\Controllers\Doctor\LaboratoriesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/


Route::group(
 [
  'prefix' => LaravelLocalization::setLocale(),
  'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
 ], function(){ 

  // =============== Dashboard User ================       
  Route::get('/user/dashboard', function () {
     return view('Dashboard.User.dashboard');
   })->middleware(['auth'])->name('dashboard.user');
   
   // =============== Dashboard Admin ================       
   Route::get('/admin/dashboard', function () {
   return view('Dashboard.Admin.dashboard');
  })->middleware(['auth:admin'])->name('dashboard.admin');
  
  Route::middleware('auth:admin')->group(function(){
     Route::prefix('admin')->group(function (){
          // =============== Section ================       
          Route::resource("/Sections", SectionController::class);

          // =============== Doctros ================       
          Route::resource("/Doctors", DoctorController::class);
          Route::post('/Doctors.changeStatus', [DoctorController::class, 'changeStatus'])->name("Doctors.changeStatus");
          Route::post('/Doctors.changePassword', [DoctorController::class, 'changePassword'])->name("Doctors.changePassword");

          // =============== Services ================       
          Route::resource("/Services", SingleServiceController::class);

          // =============== Insurances Services ================       
          Route::resource("/Insurances", InsuranceServicesController::class);

          // =============== Ambulances Services ================       
          Route::resource("/Ambulances", AmbulanceServicesController::class);

          // =============== Patient ================       
          Route::resource("/Patients", PatientsController::class);

          // =============== Finances ================       
          Route::resource("/Receipts", ReceiptAccountController::class);

          // =============== Payments ================       
          Route::resource("/Payments", PaymentAccountController::class);

          // =============== RayEmployees ================       
          Route::resource("/RayEmployees", RayEmployeesController::class);

          // =============== Appointments ================       
          Route::get("/Appointments", [Appointments::class, 'index'])->name('Appointments');
          Route::get("/Appointments/Completed", [Appointments::class, 'completed'])->name('Appointments.completed');
          Route::get("/Appointments/Approved", [Appointments::class, 'approved'])->name('Appointments.approved');
          Route::put('Appointments/Approval/{id}',[Appointments::class,'approval'])->name('Appointments.approval');

          // =============== LaboratoryEmployees ================       
          Route::resource("/LaboratoryEmployees", LaboratoryEmployeesController::class);

          // =============== GroupServices Livewire ================       
          Route::view('GroupServices','livewire.GroupServices.include_create')->name('GroupServices');

          // =============== SingleInvoices Livewire ================       
          Route::view('SingleInvoices','livewire.SingleInvoices.index')->name('SingleInvoices');
          Route::view('PrintInvoice','livewire.SingleInvoices.print')->name('PrintInvoice');

          // =============== GroupInvoices Livewire ================       
          Route::view('GroupInvoices','livewire.GroupInvoices.index')->name('GroupInvoices');
          Route::view('PrintGroupInvoice','livewire.GroupInvoices.print')->name('PrintGroupInvoice');
     });
  });
  

  
  require __DIR__.'/auth.php';
  
 });