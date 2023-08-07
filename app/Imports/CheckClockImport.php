<?php

namespace App\Imports;

use App\Models\CheckClock;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CheckClockImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CheckClock([
            'nik' => $row['nip'],
            'nama' => $row['nama'],
            'tanggal' => Carbon::parse($row['tanggal'])->toDateString(),
            'scan_1' => $row['scan_1'],
            'scan_2' => $row['scan_2'],
            'scan_3' => $row['scan_3'],
            'scan_4' => $row['scan_4'],
            'scan_5' => $row['scan_5'],
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
