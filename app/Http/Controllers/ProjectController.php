<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException; 
use Exception;

class ProjectController extends Controller
{
    // Define service
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        // Inisiasi auth service
        $this->projectService = $projectService;
    }

    public function store(Request $request) {
        try {
            // Simpan data
            $this->projectService->store($request);

            // Return response sukses, redirect ke Dashboard
            return redirect()->route('dashboard')->with('success', 'Proyek berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->route('dashboard')->with('error', 'Validasi gagal: ' . $e->getMessage());
        } catch (QueryException $e) {
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan pada database');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Gagal memuat proyek: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id) {
        try {
            // Update data
            $this->projectService->update($request, $id);

            // Return response sukses, redirect ke Dashboard
            return redirect()->route('dashboard')->with('success', 'Proyek berhasil diperbarui!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard')->with('error', 'Proyek tidak ditemukan.');
        } catch (QueryException $e) {
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan pada database');
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Gagal memperbarui proyek: ' . $e->getMessage());
        }
    }    

    public function destroy($id) {
        try {
            // Hapus data
            $this->projectService->delete($id);

             // Return response sukses, redirect ke Dashboard
            return redirect()->route('dashboard')->with('success', 'Proyek berhasil dihapus!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard')->with('error', 'Proyek tidak ditemukan.');
        } catch (QueryException $e) {
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan pada database');
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Gagal menghapus proyek: ' . $e->getMessage());
        }    
    }
    
}
