<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\ResponseResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException; 

class AuthApiController extends Controller
{
    // Define auth service
    protected $authService;

    public function __construct(AuthService $authService)
    {
        // Inisiasi auth service
        $this->authService = $authService;
    }
    
    public function register(Request $request)
    {
        try {

            // Simpan data ke database
            $user = $this->authService->registration($request);

            // Return response sukses
            return (new ResponseResource(true, 'Data User berhasil ditambahkan!', $user))
                ->response()
                ->setStatusCode(201);
        } catch (ValidationException $e) {
            return (new ResponseResource(false, 'Validasi gagal', null, $e->errors()))
                ->response()
                ->setStatusCode(422);
        } catch (QueryException $e) {
            return (new ResponseResource(false, 'Terjadi kesalahan pada database', null, null))
                ->response()
                ->setStatusCode(500);
        } catch (\Exception $e) {
            return (new ResponseResource(false, 'Terjadi kesalahan server', null, $e->getMessage()))
                ->response()
                ->setStatusCode(500);
        }
    }

    public function login(Request $request)
    {
        try {

            // Get credentials
            $credentials = $this->authService->login($request);

            
            if(!$token = auth()->guard('api')->attempt($credentials)) {
                // Return response gagal 
                return (new ResponseResource(false, 'Invalid credentials',null,)) 
                    ->response()
                    ->setStatusCode(401);
            }

            // Return response sukses 
            return (new ResponseResource(true, 'Berhasil Login', 
                [
                    'token'   => $token   
                ]))
            ->response()
            ->setStatusCode(200);
        } catch (JWTException  $e) {
            return (new ResponseResource(false, 'Gagal membuat token', null, $e->getMessage()))
                ->response()
                ->setStatusCode(500);
        } catch (\Exception $e) {
            return (new ResponseResource(false, 'Terjadi kesalahan', null, $e->getMessage()))
                ->response()
                ->setStatusCode(500);
        }
    } 

    public function logout(Request $request)
    {        
        try { 
            // Menjalankan fungsi logout dari service
            $this->authService->logout();

            return (new ResponseResource(true, 'Logout Berhasil!', null, null))
                    ->response()
                    ->setStatusCode(200);
        } catch (JWTException $e) {
            return (new ResponseResource(false, 'Gagal logout, terjadi kesalahan.', null, $e->getMessage()))
                    ->response()
                    ->setStatusCode(500);

        }
    }

    
}
