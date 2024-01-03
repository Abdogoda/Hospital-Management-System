<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string("email")->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string("password");
            $table->string('appointments')->nullable();
            $table->string("phone")->unique();
            $table->boolean("status")->default(1);
            $table->foreignId("section_id")->references('id')->on('sections')->cascadeOnDelete();
            $table->timestamps();
        });
    }


    public function down(): void{
        Schema::dropIfExists('doctors');
    }
};