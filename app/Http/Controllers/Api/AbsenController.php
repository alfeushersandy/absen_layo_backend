<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $absen = Absen::with(['jenisAbsen', 'karyawan'])->where('id_kary', auth()->guard('api')->user()->id_kary)->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'list request : '. auth()->guard('api')->user()->nik,
            'data' => $absen
        ]);
    }
}
