<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->enum('type', ['مؤكد', 'غير مؤكد', 'منتهي'])->default('غير مؤكد');
            $table->dateTime('date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('appointments');
    }
};