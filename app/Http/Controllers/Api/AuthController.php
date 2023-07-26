<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.api')->except(['login']);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $credential = $request->only('nik', 'password');

        $token = auth()->guard('api')->attempt($credential);

        if(!$token){
            return response()->json([
                'success' => false,
                'message' => "email or password incorect!"
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user'    => auth()->guard('api')->user(),  
            'token'   => $token   
        ], 201);
    }

    public function getUser()
    {
        return response()->json([
                'success' => true,
                'user'    => auth()->user()
            ], 200);
    }
}
