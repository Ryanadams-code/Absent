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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama kelas (e.g., X-A, XI-IPA-1)
            $table->string('code')->unique(); // Kode kelas
            $table->integer('capacity')->nullable(); // Kapasitas siswa
            $table->string('grade_level'); // Tingkat kelas (e.g., X, XI, XII)
            $table->string('major')->nullable(); // Jurusan (e.g., IPA, IPS, Bahasa)
            $table->text('description')->nullable(); // Deskripsi kelas
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status kelas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};