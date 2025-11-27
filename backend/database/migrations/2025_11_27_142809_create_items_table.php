<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['bilan', 'outil', 'jeu']);
            $table->text('description')->nullable();
            $table->string('creator')->nullable();
            $table->enum('status', ['officiel', 'diy'])->default('officiel');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
