<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->references('id')->on('conversations');
            $table->string('sender_email');
            $table->string('receiver_email');
            $table->text('body')->nullable();
            $table->boolean('read')->default(0)->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('messages');
    }
};