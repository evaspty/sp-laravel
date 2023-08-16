<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use FIrebase\JWT\Key;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $jwt = $request->bearerToken();

        if($jwt == 'null' || $jwt == '' )
        {
            return response()->json([
                'msg' => 'Akses ditolak, token tidak memenuhi'
            ],401);
        } else {
            $jwtDecode = JWT::decode($jwt, new Key(env('JWT_SECRET_KEY'), 'HS356'));

            if($jwtDecode()->role == 'admin') 
            {
                return $next($request);
            }

            return response()->json([
                'msg' => 'Akses ditolak, token tidak memebuhi'
            ],401);
        }
    }
}
