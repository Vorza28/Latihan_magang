<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $fillable = ['tahun', 'nominal'];

    public function siswas()
    {
    return $this->hasMany(Siswa::class);
    }

    public function pembayarans()
    {
    return $this->hasMany(Pembayaran::class);
    }
}
