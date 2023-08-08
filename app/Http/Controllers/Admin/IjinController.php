<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Izin;
use App\Models\JenisAbsen;
use App\Models\JenisIzin;
use App\Models\Karyawan;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Diff\Diff;

class IjinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absen = JenisAbsen::all();
        if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin')){
            $karyawan = Karyawan::all();
            $izin = Absen::when(request()->search, function($search){
                $search = $search->where('id_kary', 'like', '%'. request()->search. '%');
            })->with('karyawan')->paginate(10);
        }else if (Auth::user()->spesial ) {
            $karyawan = Karyawan::where('user_appr', Auth::user()->nik)->orWhere('id', Auth::user()->id_kary)->get();
            $izin = Absen::when(request()->search, function($search){
                $search = $search->where('id_kary', 'like', '%'. request()->search. '%');
            })->with('karyawan')->where('id_kary', Auth::user()->id_kary)->whereHas('karyawan', function($q){
                $q->where('user_appr', Auth::user()->nik);
            })->paginate(10);
        }else{
            $karyawan = Karyawan::where('id', Auth::user()->id_kary)->get();
            $izin = Absen::when(request()->search, function($search){
                $search = $search->where('id_kary', 'like', '%'. request()->search. '%');
            })->with('karyawan')->where('id_kary', Auth::user()->id_kary)->paginate(10);
        }

        return view('admin.izin.index', compact('karyawan', 'izin', 'absen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $karyawan = Karyawan::all();
        $izin = JenisAbsen::all();
        return view('admin.izin.create', compact('karyawan', 'izin'));
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
            'abs_id' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
        ]);

        $izin = Absen::latest()->first() ?? new Absen();
        $kode_form = substr($izin->kode_form,5);
        $kode_form_final = (int) $kode_form +1;

        $tanggal_awal = new DateTime($request->tanggal_awal);
        $tanggal_akhir = new DateTime($request->tanggal_akhir);
        $karyawan = Karyawan::with('user')->where('karyawans.id', $request->id_kary)->get();
        
        $absen = Absen::create([
            "kode_form" => 'LYSF-'.$kode_form_final,
            "id_kary" => $request->id_kary,
            "abs_id" => $request->abs_id,
            "tanggal_awal" => $request->tanggal_awal,
            "tanggal_akhir" => $request->tanggal_akhir,
            "jumlah_hari" => $tanggal_akhir->Diff($tanggal_awal)->days + 1,
            "keterangan" => $request->keterangan,
            "status" => "Pending"
        ]);

        return redirect(route('admin.absens.index'))->with('success', "permohonan telah diteruskan kepada ".$karyawan[0]->user->karyawan->nama);

    }

    public function approve(Absen $absen)
    {
        if(Auth::user()->id_kary == $absen->id_kary){
            return back()->with('warning', 'anda tidak dapat memproses ijin anda sendiri');
        }else{
            $absen->status = "Approved";
            $absen->approv_by = Auth::user()->id; 
            $absen->update();
    
            return back()->with('toast_success', 'Berhasil Approve permohonan dengan nomor '. $absen->kode_form);

        }
    }

    public function rejected(Absen $absen)
    {
        $absen->status = "Rejected";
        $absen->reject_by = Auth::user()->id; 
        $absen->update();

        return back()->with('toast_success', 'permohonan dengan nomor '. $absen->kode_form. 'telah direject');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
