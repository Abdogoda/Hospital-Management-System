<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->dateTime('review_date')->nullable();
            $table->longText('diagnosis');
            $table->longText('medicine');
            $table->foreignId('invoice_id')->references('id')->on('invoices')->cascadeOnDelete();
            $table->foreignId('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('diagnostics');
    }
};