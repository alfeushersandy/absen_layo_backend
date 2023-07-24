<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisAbsen;
use Illuminate\Http\Request;

class JenisAbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisabsen = JenisAbsen::when(request()->search, function($search){
            $search = $search->where('nama_abs', 'like', '%'. request()->search. '%');
        })->paginate(10);

        return view('admin.jenisabsen.index', compact('jenisabsen'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_abs' => 'required|unique:jenis_absens',
        ]);

        JenisAbsen::create($request->all());

        return back()->with('toast_success', 'Data berhasil disimpan');
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
    public function update(Request $request, JenisAbsen $jenisabsen)
    {
        $request->validate([
            'nama_izin' => 'required','unique:permissions,nama_izin'. $jenisabsen,
        ]);

        $jenisabsen->update($request->all());

        return back()->with('toast_success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisAbsen $jenisabsen)
    {
        $jenisabsen->delete();

        return back()->with('toast_success', 'Data berhasil dihapus');
    }
}
