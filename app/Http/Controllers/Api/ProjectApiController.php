<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\ResponseResource;
use Illuminate\Validation\ValidationException;

class ProjectApiController extends Controller
{
    // Define service
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        // Inisiasi auth service
        $this->projectService = $projectService;
    }

    public function showAll()
    {
        try {
            // Get data project
            $response = $this->projectService->showAll();
            
            // Return response
            return (new ResponseResource(true, 'Daftar data Proyek', $response, null))
                ->response()
                ->setStatusCode(200);
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

    public function showByLoginUser()
    {
        try {
            // Get data project berdasarkan user yang sedang login
            $response = $this->projectService->showByLoginUser();
            
            // Return response
            return (new ResponseResource(true, 'Daftar data Proyek', $response, null))
                ->response()
                ->setStatusCode(200);
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

    public function store(Request $request)
    {
        try {
            // Simpan data
            $project = $this->projectService->store($request);

            // Return response sukses
            return (new ResponseResource(true, 'Data Proyek berhasil ditambahkan!', $project))
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

    public function update(Request $request, $id)
    {
        try {
            
            // Update data
            $project = $this->projectService->update($request,$id);

            // Return response sukses
            return (new ResponseResource(true, 'Data Proyek berhasil diubah!', $project))
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

    public function delete($id)
    {
        try {
            // Update data
            $project = $this->projectService->delete($id);

            // Return response sukses
            return (new ResponseResource(true, "Data Proyek dengan ID $id telah dihapus.", null))
                ->response()
                ->setStatusCode(200);
                
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

}
