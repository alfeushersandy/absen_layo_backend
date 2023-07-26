<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin')){
            $request = Absen::count();
            $pending = Absen::where('status', 'Pending')->count();
            $reject = Absen::where('status', 'Rejected')->count();
            $approve = Absen::where('status', 'Approved')->count();

        }elseif (Auth::user()->spesial AND Auth::user()->hasRole('user')){
            $request = Absen::whereHas('karyawan', function($query){
                return $query->where('user_appr', '=', Auth::user()->id)->orWhere('id_kary', '=', Auth::user()->id_kary);
            })->count();
            $pending = Absen::whereHas('karyawan', function($query){
                return $query->where('user_appr', '=', Auth::user()->id)->orWhere('id_kary', '=', Auth::user()->id_kary);
            })->where('status',"Pending")->count();
            $reject = Absen::whereHas('karyawan', function($query){
                return $query->where('user_appr', '=', Auth::user()->id)->orWhere('id_kary', '=', Auth::user()->id_kary);
            })->where('status',"Rejected")->count();
            $approve = Absen::whereHas('karyawan', function($query){
                return $query->where('user_appr', '=', Auth::user()->id)->orWhere('id_kary', '=', Auth::user()->id_kary);
            })->where('status',"Approved")->count();

        }else{
            $request = Absen::where('id_kary', Auth::user()->id_kary)->count();
            $pending = Absen::where('id_kary', Auth::user()->id_kary)->where('status', 'Pending')->count();
            $reject = Absen::where('id_kary', Auth::user()->id_kary)->where('status', 'Rejected')->count();
            $approve = Absen::where('id_kary', Auth::user()->id_kary)->where('status', 'Approve')->count();
        }
        return view('admin.dashboard', compact('request', 'pending', 'reject', 'approve'));
    }
}