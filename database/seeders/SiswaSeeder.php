<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama'=>'Andi Wijaya','nis'=>'2023001','kelas'=>'X-A','nilai'=>95],
            ['nama'=>'Budi Santoso','nis'=>'2023002','kelas'=>'X-A','nilai'=>88],
            ['nama'=>'Citra Lestari','nis'=>'2023003','kelas'=>'X-B','nilai'=>92],
            ['nama'=>'Dewi Anggraini','nis'=>'2023004','kelas'=>'X-B','nilai'=>85],
            ['nama'=>'Eka Pratama','nis'=>'2023005','kelas'=>'X-C','nilai'=>90],
        ];

        foreach ($data as $siswa) {
            Siswa::create($siswa);
        }
    }
}
