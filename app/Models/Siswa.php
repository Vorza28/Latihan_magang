<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'nis', 'nilai', 'kelas_id', 'spp_id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class);
    }
}
