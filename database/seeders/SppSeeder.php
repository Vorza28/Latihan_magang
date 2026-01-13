<?php

namespace Database\Seeders;

use App\Models\Spp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Spp::insert([
            ['tahun' => '2025', 'nominal' => 2000000, 'created_at'=>now(), 'updated_at'=>now()],
            ['tahun' => '2025', 'nominal' => 1500000, 'created_at'=>now(), 'updated_at'=>now()],
            ['tahun' => '2026', 'nominal' => 2000000, 'created_at'=>now(), 'updated_at'=>now()],
            ['tahun' => '2026', 'nominal' => 1500000, 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}
