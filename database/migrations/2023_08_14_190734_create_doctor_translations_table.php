<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('doctor_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['doctor_id','locale']);
            $table->foreignId("doctor_id")->references('id')->on('doctors')->cascadeOnDelete();
        });
    }

    public function down(): void{
        Schema::dropIfExists('doctor_translations');
    }
};