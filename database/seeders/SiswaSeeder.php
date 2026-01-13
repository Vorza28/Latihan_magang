<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $xa = Kelas::where('nama_kelas','X-A')->first();
        $xb = Kelas::where('nama_kelas','X-B')->first();
        $spp = Spp::orderBy('tahun','desc')->first();

        $data = [
            ['nama'=>'Andi Wijaya','nis'=>'2023001','kelas_id'=>$xa?->id,'spp_id'=>$spp?->id,'nilai'=>95],
            ['nama'=>'Budi Santoso','nis'=>'2023002','kelas_id'=>$xa?->id,'spp_id'=>$spp?->id,'nilai'=>88],
            ['nama'=>'Citra Lestari','nis'=>'2023003','kelas_id'=>$xb?->id,'spp_id'=>$spp?->id,'nilai'=>92],
            ['nama'=>'Dewi Anggraini','nis'=>'2023004','kelas_id'=>$xb?->id,'spp_id'=>$spp?->id,'nilai'=>85],
            ['nama'=>'Eka Pratama','nis'=>'2023005','kelas_id'=>$xa?->id,'spp_id'=>$spp?->id,'nilai'=>90],
            ['nama'=>'Fajar Nugroho','nis'=>'2023006','kelas_id'=>$xb?->id,'spp_id'=>$spp?->id,'nilai'=>87],
            ['nama'=>'Gina Marlina','nis'=>'2023007','kelas_id'=>$xa?->id,'spp_id'=>$spp?->id,'nilai'=>93],
            ['nama'=>'Hadi Susanto','nis'=>'2023008','kelas_id'=>$xb?->id,'spp_id'=>$spp?->id,'nilai'=>89],
        ];

        foreach ($data as $row) {
            Siswa::create($row);
        }
    }
}
