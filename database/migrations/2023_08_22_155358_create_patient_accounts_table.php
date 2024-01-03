<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('invoice_id')->nullable()->references('id')->on('invoices')->cascadeOnDelete();
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_accounts')->cascadeOnDelete();
            $table->foreignId('payment_id')->nullable()->references('id')->on('payment_accounts')->cascadeOnDelete();
            $table->foreignId('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->decimal('debit', 8, 2)->nullable();
            $table->decimal('credit', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('patient_accounts');
    }
};