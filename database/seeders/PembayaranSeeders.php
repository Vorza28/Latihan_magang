<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = Siswa::with('spp')->first();
        if (!$siswa) return;

        Pembayaran::updateOrCreate(
            ['siswa_id' => $siswa->id, 'bulan' => 1, 'tahun' => (int)date('Y')],
            [
                'spp_id' => $siswa->spp_id,
                'jumlah_bayar' => 1500000,
                'tanggal_bayar' => now()->toDateString(),
                'status' => 'lunas',
                'keterangan' => 'Seeder demo',
            ]
        );
    }
}
