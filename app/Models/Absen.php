<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_form', 'id_kary', 'abs_id', 'tanggal_awal', 'tanggal_akhir', 'jumlah_hari', 'keterangan', 'status', 'approv_by'
    ];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id', 'id_kary');
    }

    public function jenisAbsen() 
    {
        return $this->hasMany(JenisAbsen::class, 'id', 'abs_id');
    }
}
