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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id()->nullable(false);
            $table->string('nama_kegiatan', 50);
            $table->dateTime('waktu_kegiatan');
            $table->string('total_kelas', 100);
            $table->string('kelas_terlibat', 100);
            $table->string('total_kehadiran', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
