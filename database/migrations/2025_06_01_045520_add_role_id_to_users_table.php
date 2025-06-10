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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom role_id sebagai foreign key yang mengacu ke tabel roles
            // Default value 1 untuk 'Warga' (kita akan pastikan 'Warga' adalah role pertama di seeder)
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key dan kolom role_id saat rollback
            $table->dropConstrainedForeignId('role_id');
        });
    }
};