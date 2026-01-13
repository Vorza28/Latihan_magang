<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::insert([
            ['nama_kelas' => 'X-A', 'wali_kelas' => 'Pak Andi', 'created_at'=>now(), 'updated_at'=>now()],
            ['nama_kelas' => 'X-B', 'wali_kelas' => 'Bu Rina', 'created_at'=>now(), 'updated_at'=>now()],
            ['nama_kelas' => 'X-C', 'wali_kelas' => 'Pak Budi', 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
