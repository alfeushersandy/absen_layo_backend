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

        $reports = Absen::leftjoin('karyawans', 'karyawans.id', '=', 'absens.id_kary')
                    ->where('status', 'Approved')
                    ->groupBy('nik_karyawan')
                    ->selectRaw('nik_karyawan, nama, sum(jumlah_hari) as jumlah_hari')
                    ->whereDate('tanggal_awal', '>=', $fromDate)
                    ->whereDate('tanggal_akhir', '<=', $toDate)
                    ->get();

        return view('admin.report.index', compact('fromDate', 'toDate', 'reports'));
    }

    public function pdf($fromDate, $toDate)
    {
        $reports = Transaction::with('details', 'user')
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->get();

        $grandQuantity = TransactionDetail::with('products')
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->sum('quantity');

        $pdf = PDF::loadView('backoffice.report.report', compact('fromDate', 'toDate', 'reports', 'grandQuantity'))->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan - '.Carbon::parse($fromDate)->format('d M Y').' - '.Carbon::parse($toDate)->format('d M Y').'.pdf');
    }
}
