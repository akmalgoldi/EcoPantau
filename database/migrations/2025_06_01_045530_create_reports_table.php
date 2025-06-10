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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pelapor
            $table->string('location');
            $table->text('description');
            $table->string('photo')->nullable(); // Path gambar, bisa kosong
            // Foreign key ke tabel report_statuses, default ke status 'Baru'
            $table->foreignId('report_status_id')->constrained('report_statuses')->onDelete('cascade')->default(1);
            $table->text('admin_notes')->nullable(); // Catatan penanganan oleh Admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};