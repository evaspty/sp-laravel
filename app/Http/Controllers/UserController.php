<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT; //panggil library JWT
use Illuminate\Support\Facades\Validator; //panggil validator untuk memvalidasi inputan
use Illuminate\Support\Facades\Auth; //panggil fungsi auth(ini otomatis menggunakan tabel user untuk)
use Carbon\Carbon;

class UserController extends Controller
{

   function login (Request $request)
   {
     $validator = Validator($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
     ]);

     if($validator->fails()) 
     {
        return response()->json($validator->messages(), 422);
     }
     $validated = $validator->validate();

     if(Auth::attempt($validated))
     {
        $payload = [
            'name' => 'Administrator',
            'role' => 'admin',
            'iat' => Carbon::now()->timestamp,
            'name' => Carbon::now()->timestamp + 60*60*2
        ];

        $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');

        return response()->json([
            'msg' => 'token berhasil dibuat',
            'data' => 'Bearer'.$token
        ],200);
      } else {
        return response()->json([
            'msg' => 'Email atau password salah'
        ], 422);
      }
   }
}