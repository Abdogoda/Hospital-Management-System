<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->foreignId('invoice_id')->references('id')->on('invoices')->cascadeOnDelete();
            $table->foreignId('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->references('id')->on('laboratory_employees')->cascadeOnDelete();
            $table->longText('description_employee')->nullable();
            $table->tinyInteger('case')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('laboratories');
    }
};