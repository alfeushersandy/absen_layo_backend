<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_form_lembur', 'id_kary', 'jenis_lembur', 'tanggal', 'dari', 'sampai', 'jam', 'istirahat', 'keterangan', 'status'
    ];

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'id', 'id_kary');
    }
}
