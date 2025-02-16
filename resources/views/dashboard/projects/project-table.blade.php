<!-- Daftar Proyek -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg">
    <table class="w-full text-left">
        <thead>
            <tr class="border-b border-gray-600">
                <th class="p-2">No.</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Deskripsi</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $index => $project)
            <tr class="border-b border-gray-600">
                <td class="p-2 ">{{ $index + 1 }}</td>
                <td class="p-2 font-semibold">{{ $project->name }}</td>
                <td class="p-2">{{ $project->description }}</td>
                <td class="p-2">
                    <div class="flex items-center space-x-2">
                        <button @click="modalOpen = true; isEdit = true; projectId = '{{ $project->id }}'; projectName = '{{ $project->name }}'; projectDescription = '{{ $project->description }}';"
                                class="text-indigo-400 hover:text-indigo-600">
                            Ubah
                        </button>
                        
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-indigo-400 hover:text-indigo-600">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
