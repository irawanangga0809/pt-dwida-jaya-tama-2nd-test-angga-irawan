@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('components.alerts')

    <!-- Konten Dashboard -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Daftar Proyek</h2>

        <div x-data="{ modalOpen: false, isEdit: false, projectId: '', projectName: '', projectDescription: '' }">

            <!-- Tombol Tambah Proyek -->
            <button @click="modalOpen = true; isEdit = false; projectId = ''; projectName = ''; projectDescription = '';" 
                    class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                Tambah Proyek
            </button>     

            <!-- Modal Tambah/Ubah Proyek -->
            @include('dashboard.projects.project-modal')

            <!-- Daftar Proyek -->
            @include('dashboard.projects.project-table', ['projects' => $projects])

        </div>
    </div>

@endsection
