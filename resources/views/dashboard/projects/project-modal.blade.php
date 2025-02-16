<!-- Modal Tambah/Ubah Proyek -->
<div x-show="modalOpen" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96 text-white">
        <!-- Tombol Close -->
        <button @click="modalOpen = false; isEdit = false;" class="absolute top-3 right-3 text-gray-400 hover:text-gray-200">
            &times;
        </button>

        <!-- Judul Modal -->
        <h2 class="text-2xl font-semibold mb-6 text-white" x-text="isEdit ? 'Ubah Proyek' : 'Tambah Proyek Baru'"></h2>

        <!-- Form -->
        <form :action="isEdit ? `/projects/${projectId}` : `{{ route('projects.store') }}`" method="POST">
            @csrf
            <template x-if="isEdit">
                <input type="hidden" name="_method" value="PUT">
            </template>

            <!-- Input Nama Proyek -->
            <div class="mb-4">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Nama Proyek</label>
                <input type="text" name="name" x-model="projectName" required
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none text-white">
            </div>

            <!-- Input Deskripsi -->
            <div class="mb-4">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Deskripsi</label>
                <textarea name="description" x-model="projectDescription"
                          class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none text-white"></textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end">
                <button type="button" @click="modalOpen = false; isEdit = false;"
                        class="mr-2 px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600 transition">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
