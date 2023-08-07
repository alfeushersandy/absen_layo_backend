<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckClock extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik', 'nama', 'tanggal', 'scan_1', 'scan_2', 'scan_3', 'scan_4', 'scan_5', 'keterangan'
    ];

    protected function tanggal(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Carbon::parse($value)->format('d-M-Y'),
        );
    }
}
