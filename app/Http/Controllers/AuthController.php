<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; 
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    //Define auth service
    protected $authService;

    public function __construct(AuthService $authService)
    {
        // Inisiasi auth service
        $this->authService = $authService;
    }
    
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        try {
            // Validasi input
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('username', 'password');
    
            // Ambil kredensial
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
            ];
    
            // Coba login
            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard')->with('success', 'Berhasil login!');
            }
    
            // Jika gagal login
            return back()->with('error', 'Username atau password salah.');
    
        } catch (ValidationException $e) { 
            return back()->with('error', 'Validasi gagal: ' . $e->getMessage());
        } catch (QueryException $e) {
            return back()->with('error', 'Terjadi kesalahan pada database');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal login: ' . $e->getMessage());
        }
    }
    
    public function logout() {
        try {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Berhasil logout!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal logout: ' . $e->getMessage());
        }
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            // Simpan data ke database
            $this->authService->registration($request);

            // Return response sukses, redirect ke Dashboard
            return redirect()->route('login')->with('success', 'Registrasi berhasil!');
        } catch (ValidationException $e) { 
            return back()->with('error', 'Validasi gagal: ' . $e->getMessage());
        } catch (QueryException $e) {
            return back()->with('error', 'Terjadi kesalahan pada database');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal register: ' . $e->getMessage());
        }
    }
}
