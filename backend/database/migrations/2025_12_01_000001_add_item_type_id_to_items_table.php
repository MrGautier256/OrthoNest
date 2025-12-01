<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreignId('item_type_id')
                ->nullable()
                ->after('id')
                ->constrained('item_types');

            $table->dropColumn('type');
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->enum('type', ['bilan', 'outil', 'jeu'])->nullable();
            $table->dropConstrainedForeignId('item_type_id');
        });
    }
};
