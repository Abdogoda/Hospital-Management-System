<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('section_translations', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->longText("description")->nullable();
            $table->string("locale")->index();
            $table->unique(['section_id','locale']);
            $table->foreignId("section_id")->references("id")->on("sections")->cascadeOnDelete();

        });
    }

    public function down(): void{
        Schema::dropIfExists('section_translations');
    }
};