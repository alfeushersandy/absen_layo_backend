<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik_karyawan', 'nama', 'tanggal_join', 'departemen_id', 'user_appr', 'section', 'jabatan'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'nik', 'user_appr');
    }

    public function departemen()
    {
        return $this->hasOne(Departemen::class, 'id', 'departemen_id');
    }
}