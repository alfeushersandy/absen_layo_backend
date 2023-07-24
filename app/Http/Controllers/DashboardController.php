<?php

namespace App\Http\Controllers;

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
            return view('admin.dashboard');
        }else{
            return view('user.dashboard');
        }
    }
}
