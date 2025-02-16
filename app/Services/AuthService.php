<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function registration(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ]);

        // Simpan Ke DB
        return User::create([
            'username' => $validated['username'],
            'password' => $validated['password'],
        ]);
    }

    public function login(Request $request){
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Get credentials
        $credentials = $request->only('username', 'password');

        return $credentials;

    }

    public function logout(){
        // Ambil token dari request
        $token = JWTAuth::getToken();

        if (!$token) {
            throw new \Exception("Token tidak ditemukan");
        }

        // Invalidasi token agar tidak bisa digunakan lagi
       JWTAuth::invalidate($token);
       return ;
    }
}
