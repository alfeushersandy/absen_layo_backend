<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KaryawanRequest;
use App\Models\Departemen;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = Karyawan::with(['user'])->when(request()->search, function($search){
            $search = $search->where('nama', 'like', '%'. request()->search. '%')->orWhere('nik_karyawan', 'like', '%'. request()->search. '%');
        })->paginate(10);

        return view('admin.karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::with(['karyawan'])->get();
        $dept = Departemen::all();

        return view('admin.karyawan.create', compact('users', 'dept'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KaryawanRequest $request)
    {
        Karyawan::create([
            'nik_karyawan' => $request->nik_karyawan,
            'nama' => $request->nama,
            'tanggal_join' => $request->tanggal_join,
            'departemen_id' => $request->departemen_id,
            'user_appr' => $request->user_approve,
        ]);

        return redirect(route('admin.karyawans.index'))->with('toast_success', 'Data karyawan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        $users = User::with(['karyawan'])->get();
        $dept = Departemen::all();

        return view('admin.karyawan.edit', compact('users', 'dept', 'karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KaryawanRequest $request, Karyawan $karyawan)
    {
        $karyawan->update([
            'nik_karyawan' => $request->nik_karyawan,
            'nama' => $request->nama,
            'tanggal_join' => $request->tanggal_join,
            'departemen_id' => $request->departemen_id,
            'user_appr' => $request->user_approve,
        ]);

        return redirect(route('admin.karyawans.index'))->with('toast_success', 'Data karyawan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return back()->with('toast_success', 'Data berhasil dihapus');
    }
}
