<?php

namespace App\Providers;

use App\Interfaces\DoctorDashboard\DiagnosticsRepositoryInterface;
use App\Interfaces\DoctorDashboard\InvoicesRepositoryInterface;
use App\Interfaces\DoctorDashboard\LaboratorieRepositoryInterface;
use App\Interfaces\DoctorDashboard\RayRepositoryInterface;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\Finances\PaymentRepositoryInterface;
use App\Interfaces\Finances\ReceiptRepositoryInterface;
use App\Interfaces\LaboratoryEmployees\LaboratoryEmployeeRepositoryInterface;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Interfaces\RayEmployeeDashboard\InvoicesRepositoryInterface as RayEmployeeInvoicesRepositoryInterface;
use App\Interfaces\LaboratoryEmployeeDashboard\InvoicesRepositoryInterface as LaboratoryEmployeeInvoicesRepositoryInterface;
use App\Interfaces\PatientDashboard\InvoicesRepositoryInterface as PatientDashboardInvoicesRepositoryInterface;
use App\Interfaces\RayEmployees\RayEmployeeRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Interfaces\Services\AmbulanceServiceRepositoryInterface;
use App\Interfaces\Services\InsuranceServiceRepositoryInterface;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Repository\DoctorDashboard\DiagnosticsRepository;
use App\Repository\DoctorDashboard\InvoicesRepository;
use App\Repository\DoctorDashboard\LaboratorieRepository;
use App\Repository\DoctorDashboard\RayRepository;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Finances\PaymentRepository;
use App\Repository\Finances\ReceiptRepository;
use App\Repository\LaboratoryEmployees\LaboratoryEmployeeRepository;
use App\Repository\Patients\PatientRepository;
use App\Repository\RayEmployeeDashboard\InvoicesRepository as RayEmployeeInvoicesRepository;
use App\Repository\LaboratoryEmployeeDashboard\InvoicesRepository as LaboratoryEmployeeInvoicesRepository;
use App\Repository\PatientDashboard\InvoicesRepository as PatientDashboardInvoicesRepository;
use App\Repository\RayEmployees\RayEmployeeRepository;
use App\Repository\Sections\SectionRepository;
use App\Repository\Services\AmbulanceServiceRepository;
use App\Repository\Services\InsuranceServiceRepository;
use App\Repository\Services\SingleServiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider{

    public function register(): void{
    
        // Admin Bindings
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(SingleServiceRepositoryInterface::class, SingleServiceRepository::class);
        $this->app->bind(InsuranceServiceRepositoryInterface::class, InsuranceServiceRepository::class);
        $this->app->bind(AmbulanceServiceRepositoryInterface::class, AmbulanceServiceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(RayEmployeeRepositoryInterface::class, RayEmployeeRepository::class);
        $this->app->bind(LaboratoryEmployeeRepositoryInterface::class, LaboratoryEmployeeRepository::class);
    
        // Doctor Bindings
        $this->app->bind(InvoicesRepositoryInterface::class, InvoicesRepository::class);
        $this->app->bind(DiagnosticsRepositoryInterface::class, DiagnosticsRepository::class);
        $this->app->bind(RayRepositoryInterface::class, RayRepository::class);
        $this->app->bind(LaboratorieRepositoryInterface::class, LaboratorieRepository::class);

        // RayEmployee Bindings
        $this->app->bind(RayEmployeeInvoicesRepositoryInterface::class, RayEmployeeInvoicesRepository::class);

        // LaboratoryEmployee Bindings
        $this->app->bind(LaboratoryEmployeeInvoicesRepositoryInterface::class, LaboratoryEmployeeInvoicesRepository::class);

        // Patient Bindings
        $this->app->bind(PatientDashboardInvoicesRepositoryInterface::class, PatientDashboardInvoicesRepository::class);
    }

    public function boot(): void{
        //
    }
}