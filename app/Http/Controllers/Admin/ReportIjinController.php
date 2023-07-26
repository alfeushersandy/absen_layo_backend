<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;

class ReportIjinController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        return view('admin.report.index', compact('fromDate', 'toDate'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'from_date' => 'required|',
            'to_date' => 'required|',
        ]);

        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        $reports =  Absen::leftjoin('karyawans', 'karyawans.id', '=', 'absens.id_kary')
                    ->groupBy('nik_karyawan')
                    ->where('status', 'Approved')
                    ->selectRaw('nik_karyawan, nama, sum(jumlah_hari) as jumlah_hari')
                    ->whereDate('tanggal_awal', '>=', $fromDate)
                    ->whereDate('tanggal_akhir', '<=', $toDate)
                    ->get();

        return view('admin.report.index', compact('fromDate', 'toDate', 'reports'));
    }

}