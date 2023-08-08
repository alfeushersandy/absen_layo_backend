<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\JenisAbsen;
use App\Models\Karyawan;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function getKaryawan()
    {
        $user = User::find(auth()->user()->id);
        if($user->hasRole('user') && $user->spesial == 1){
            $karyawan = Karyawan::where('user_appr', $user->id)->orWhere('id', $user->id_kary)->get();
        }else{
            $karyawan = Karyawan::latest()->get();
        }

        return response()->json([
            'success' => true,
            'karyawan' => $karyawan
        ]);
    }

    public function getJenisAbsen()
    {
        $jenis_absen = JenisAbsen::latest()->get();

        return response()->json([
            'success' => true,
            'jenisAbsen' => $jenis_absen
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'id_jenis_absen' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $izin = Absen::latest()->first() ?? new Absen();
        $kode_form = substr($izin->kode_form,5);
        $kode_form_final = (int) $kode_form +1;

        $tanggal_awal = new DateTime($request->tanggal_awal);
        $tanggal_akhir = new DateTime($request->tanggal_akhir);
        $karyawan = Karyawan::with('user')->where('karyawans.id', $request->id_kary)->get();
        
        $absen = Absen::create([
            "kode_form" => 'LYSF-'.$kode_form_final,
            "id_kary" => $request->id_karyawan,
            "abs_id" => $request->id_jenis_absen,
            "tanggal_awal" => $request->tanggal_awal,
            "tanggal_akhir" => $request->tanggal_akhir,
            "jumlah_hari" => $tanggal_akhir->Diff($tanggal_awal)->days + 1,
            "keterangan" => $request->keterangan,
            "status" => "Pending"
        ]);

        return response()->json([
            'success' => true,
            'absen' => $absen
        ]);
    }

    public function approve($id)
    {
        $user = User::find(auth()->user()->id);
        $absen = Absen::find($id);
        if($absen->id_kary == $user->id_kary){
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak diperkenankan untuk memproses Ijin anda sendiri',
                'absen' => '',
            ]);
        }else{
            $absen->status = "Approved";
            $absen->approv_by = $user->id; 
            $absen->update();
    
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Approve permohonan dengan nomor '. $absen->kode_form,
                'absen' => $absen,
                'user' => $user
            ]);

        }
    }

    public function rejected($id)
    {
        $user = User::find(auth()->user()->id);
        $absen = Absen::find($id);

        if($absen->id_kary == $user->id_kary){
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak diperkenankan untuk memproses Ijin anda sendiri',
                'absen' => '',
            ]);
        }else{
            $absen->status = "Rejected";
            $absen->reject_by = $user->id; 
            $absen->update();
    
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Reject permohonan dengan nomor '. $absen->kode_form,
                'absen' => $absen,
                'user' => $user
            ]);

        }
    }
}
