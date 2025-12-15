<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('table_name'); // Nama tabel yang diubah
            $table->string('action'); // create, update, delete, restore, force_delete
            $table->json('old_data')->nullable(); // Data sebelum perubahan
            $table->json('new_data')->nullable(); // Data setelah perubahan
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // User yang melakukan aksi
            $table->timestamps(); // created_at, updated_at

            // Index untuk performa query
            $table->index('table_name');
            $table->index('action');
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};