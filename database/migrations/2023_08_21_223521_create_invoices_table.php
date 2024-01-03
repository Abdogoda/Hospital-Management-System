<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_type');
            $table->date('invoice_date');
            $table->foreignId('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->foreignId('section_id')->references('id')->on('sections')->cascadeOnDelete();
            $table->foreignId('group_id')->nullable()->references('id')->on('groups')->cascadeOnDelete();
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->cascadeOnDelete();
            $table->double('price',8,2)->default(0);
            $table->double('discount_value',8,2)->default(0);
            $table->string('tax_rate');
            $table->string('tax_value');
            $table->double('total_with_tax',8,2)->default(0);
            $table->integer('type')->default(1);
            $table->integer('invoice_status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('invoices');
    }
};