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
    Schema::table('tasks', function (Blueprint $table) {
        $table->date('due_date')->nullable(); // Menambahkan tenggat waktu (bisa dikosongkan)
        $table->string('category')->nullable(); // Menambahkan kategori
        $table->softDeletes(); // Menambahkan kolom deleted_at untuk fitur Soft Deletes
    });
}

public function down(): void
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->dropColumn(['due_date', 'category']);
        $table->dropSoftDeletes();
    });
}
};
