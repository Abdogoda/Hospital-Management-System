<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    
    public function up(): void{
        Schema::create('insurance_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('name');
            $table->string('notes')->nullable();
            $table->unique(['locale', 'name', 'insurance_id']);
            $table->foreignId('insurance_id')->references('id')->on('insurances')->cascadeOnDelete();
        });
    }

    public function down(): void{
        Schema::dropIfExists('insurance_translations');
    }
};