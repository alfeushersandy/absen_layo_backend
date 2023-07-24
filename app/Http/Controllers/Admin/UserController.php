<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['karyawan', 'roles'])->when(request()->search, function($search){
            $search = $search->where('nama', 'like', '%'. request()->search. '%');
        })->paginate(10);

        $user = User::select('id_kary')->get()->toArray();

        $karyawan = Karyawan::whereNotIn('id', $user)->get();

        $roles = Role::all();

        return view('admin.user.index', compact('users', 'karyawan', 'roles'));
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
        /**
         * Validate request
         */
        $this->validate($request, [
            'id_kary'     => 'required',
            'password' => 'required|confirmed' 
        ]);

        $karyawan = Karyawan::find($request->id_kary);

        /**
         * Create user
         */
        $user = User::create([
            'nik'     => $karyawan->nik_karyawan,
            'id_kary'     => $karyawan->id,
            'password' => bcrypt($request->password),
            'special' => $request->special_approve
        ]);

        //assign roles to user
        $user->assignRole($request->roles);

        //asign special permission
        if($request->special_approve){
            $permission = Permission::whereIn('id', [11,16])->get();
            foreach ($permission as $approve) {
                $user->givePermissionTo($approve->id);
            }
        }
       

        //redirect
        return back()->with('success', 'User Berhasil Ditambahkan');
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