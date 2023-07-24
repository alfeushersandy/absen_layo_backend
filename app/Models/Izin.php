<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_form', 'id_kary', 'id_jenis_izin', 'tanggal_awal', 'tanggal_akhir', 'jam_awal', 'jam_akhir', 'jumlah_hari', 'keterangan', 'status', 'approv_by'
    ];
}
