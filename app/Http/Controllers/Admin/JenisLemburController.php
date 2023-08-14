<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisLembur;
use Illuminate\Http\Request;

class JenisLemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenislembur = JenisLembur::when(request()->search, function($search){
            $search = $search->where('nama_izin', 'like', '%'. request()->search. '%');
        })->paginate(10);

        return view('admin.jenislembur.index', compact('jenislembur'));
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
            'jenis_lembur' => 'required|unique:jenis_lemburs',
        ]);

        JenisLembur::create($request->all());

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
    public function update(Request $request, JenisLembur $jenislembur)
    {
        $request->validate([
            'jenis_lembur' => 'required','unique:permissions,jenis_lembur'. $jenislembur,
        ]);

        $jenislembur->update($request->all());

        return back()->with('toast_success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisLembur $jenislembur)
    {
        $jenislembur->delete();

        return back()->with('toast_success', 'Data berhasil dihapus');
    }
}
