<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\JenisAbsen;
use App\Models\JenisLembur;
use App\Models\Karyawan;
use App\Models\Lembur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenislembur = JenisLembur::all();
        if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin')){
            $karyawan = Karyawan::all();
            $izin = Lembur::when(request()->search, function($search){
                $search = $search->where('id_kary', 'like', '%'. request()->search. '%');
            })->with('karyawan')->paginate(10);
        }else if(Auth::user()->spesial == true) {
            $karyawan = Karyawan::where('user_appr', Auth::user()->nik)->orWhere('id', Auth::user()->id_kary)->get();
            $izin = Lembur::when(request()->search, function($search){
                $search = $search->where('id_kary', 'like', '%'. request()->search. '%');
            })->with('karyawan')->whereHas('karyawan', function($q){
                $q->where('user_appr', Auth::user()->nik);
            })->orWhere('id_kary', '=', Auth::user()->id_kary)->paginate(10);
        }else{
            $karyawan = Karyawan::where('id', Auth::user()->id_kary)->get();
            $izin = Lembur::when(request()->search, function($search){
                $search = $search->where('id_kary', 'like', '%'. request()->search. '%');
            })->with('karyawan')->where('id_kary', Auth::user()->id_kary)->paginate(10);
        }
        
        return view('admin.lembur.index', compact('karyawan', 'izin', 'jenislembur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function approve(Lembur $lembur)
    {
        if(Auth::user()->id_kary == $lembur->id_kary){
            return back()->with('warning', 'anda tidak dapat memproses ijin anda sendiri');
        }else{
            $lembur->status = "Approved";
            $lembur->approv_by = Auth::user()->id; 
            $lembur->update();
    
            return back()->with('toast_success', 'Berhasil Approve permohonan dengan nomor '. $lembur->kode_form_lembur);

        }
    }

    public function rejected(Lembur $lembur)
    {
        $lembur->status = "Rejected";
        $lembur->reject_by = Auth::user()->id; 
        $lembur->update();

        return back()->with('toast_success', 'permohonan dengan nomor '. $lembur->kode_form_lembur. 'telah direject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kary' => 'required',
            'jenis_lembur' => 'required',
            'tanggal' => 'required',
            'dari' => 'required',
            'sampai' => 'required',
        ]);

        $lembur = Lembur::latest()->first() ?? new Lembur();
        $kode_form = substr($lembur->kode_form_lembur,7);
        $kode_form_final = (int) $kode_form +1;

        //hitung lembur 
        $dari = strtotime($request->dari);
        $sampai = strtotime($request->sampai);
        $break = $request->break*60;

        //hitung selisih dalam detik 
        $diff = ($sampai-$dari)-$break;

        //membagi detik menjadi jam
        $jam_lembur = floor($diff / (60 * 60));

        
        $karyawan = Karyawan::with('user')->where('karyawans.id', $request->id_kary)->get();
        
        Lembur::create([
            "kode_form_lembur" => 'LYSF-L-'.$kode_form_final,
            "id_kary" => $request->id_kary,
            "jenis_lembur" => $request->jenis_lembur,
            "dari" => $request->dari,
            "sampai" => $request->sampai,
            "istirahat" => $request->break,
            "jam" => $jam_lembur,
            "tanggal" => $request->tanggal,
            "keterangan" => $request->keterangan,
            "status" => "Pending"
        ]);

        return redirect(route('admin.lemburs.index'))->with('success', "permohonan Lembur telah diteruskan kepada ".$karyawan[0]->user->karyawan->nama);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //hitung lembur 
        $dari = strtotime($request->dari);
        $sampai = strtotime($request->sampai);
        $break = $request->break*60;

        //hitung selisih dalam detik 
        $diff = ($sampai-$dari)-$break;

        //membagi detik menjadi jam
        $jam_lembur = floor($diff / (60 * 60));
        $lembur = Lembur::find($id);

        $lembur->update([
            "jenis_lembur" => $request->jenis_lembur,
            "dari" => $request->dari,
            "sampai" => $request->sampai,
            "istirahat" => $request->break,
            "jam" => $jam_lembur,
            "tanggal" => $request->tanggal,
            "keterangan" => $request->keterangan,
        ]);

        return redirect(route('admin.lemburs.index'))->with('toast_success', "berhasil Mengupdate data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lembur = Lembur::find($id);
        $lembur->delete();

        return redirect(route('admin.lemburs.index'))->with('toast_success', "Berhasil Menghapus Lembur dengan nomor ". $lembur->kode_form_lembur);
    }
}
