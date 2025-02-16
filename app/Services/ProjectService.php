<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectService
{
    public function showAll()
    {
        // Get semua data proyek
        return Project::query()->get();
    }

    public function showByLoginUser()
    {
        // Get hanya data proyek berdasarkan user login
        return Project::where('user_id', Auth::id())->latest()->get();
    }

    public function store(Request $request)
    {
        // Validasi input JSON
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Simpan data ke database
        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'user_id' => Auth::id(),
        ]);

        return $project;
    }

    public function update(Request $request, $id)
    {
        // Check Proyek apakah ada di daatabase
        $project = $this->checkProjectExist($id);

         // Validasi input JSON  
         $validated = $request->validate([ 
             'name' => 'sometimes',
             'description' => 'sometimes',
         ]);

         // Update variable dengan data baru
         if (isset($validated['name'])) {
             $project->name = $validated['name']; 
         }
         if (isset($validated['description'])) {
             $project->description = $validated['description'];
         }

         // Simpan perubahan
         $project->save();

        return $project;
    }

    public function delete($id)
    {
        // Check Proyek apakah ada di daatabase
        $project = $this->checkProjectExist($id);

        $project->delete();

        // Get hanya data proyek berdasarkan user login
        return $project;
    }

    public function checkProjectExist($id)
    {
        // Validasi Id
        if (!is_numeric($id)) {
            throw new \Exception("ID harus angka");
        }

         // Cek Proyek by Id
         $project= Project::find($id);

         if (!$project) {
            throw new \Exception("Data Proyek dengan ID {$id} tidak ditemukan");
         }

         // Compare user pemilik proyek
         if ($project->user_id != Auth::id()) {
            throw new \Exception("Data Proyek dengan ID {$id} tidak bisa diubah selain pemiliknya");
         }

        return $project;
    }
}
