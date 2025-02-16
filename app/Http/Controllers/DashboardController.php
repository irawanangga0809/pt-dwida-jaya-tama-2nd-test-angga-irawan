<?php
namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException; 
use Exception;

class DashboardController extends Controller
{
    // Define service
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        // Inisiasi auth service
        $this->projectService = $projectService;
    }

    public function index() {
        try {
            // Memanggil fungsi untuk menampilkan proyek berdasarkan user login
            $projects = $this->projectService->showByLoginUser();

            // Return response sukses, redirect ke Dashboard
            return view('dashboard.index', compact('projects'));
        } catch (ValidationException $e) {
            return redirect()->route('dashboard')->with('error', 'Validasi gagal: ' . $e->getMessage());
        } catch (QueryException $e) {
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan pada database');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Gagal memuat proyek: ' . $e->getMessage());
        }
    }
}
