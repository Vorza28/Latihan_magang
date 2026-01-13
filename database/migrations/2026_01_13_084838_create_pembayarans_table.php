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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            // snapshot SPP saat bayar (biar histori konsisten)
            $table->foreignId('spp_id')
                ->nullable()
                ->constrained('spps')
                ->nullOnDelete();

            $table->unsignedTinyInteger('bulan'); // 1-12
            $table->year('tahun');

            $table->integer('jumlah_bayar')->default(0);
            $table->date('tanggal_bayar')->nullable();

            $table->enum('status', ['lunas', 'belum'])->default('belum');
            $table->string('keterangan')->nullable();

            $table->timestamps();

            // biar tidak dobel pembayaran bulan & tahun yang sama untuk siswa yang sama
            $table->unique(['siswa_id', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
