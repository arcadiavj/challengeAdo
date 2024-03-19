<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->string('api');
            $table->string('description');
            $table->string('link');
            $table->string('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->dropColumn('api'); // Eliminar la columna 'api' si se hace un rollback
            $table->dropColumn('description');
            $table->dropColumn('link');
            $table->dropColumn('category_id');
        });
    }
};
