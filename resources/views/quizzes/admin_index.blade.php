<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kuis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <a href="{{ route('admin.quizzes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Buat Kuis Baru
                    </a>

                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Judul</th>
                                <th class="px-4 py-2">Deskripsi</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizzes as $quiz)
                                <tr>
                                    <td class="border px-4 py-2">{{ $quiz->title }}</td>
                                    <td class="border px-4 py-2">{{ $quiz->description }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('admin.quizzes.show', $quiz) }}" class="text-blue-600 hover:text-blue-900">Kelola Pertanyaan</a>
                                        <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-yellow-600 hover:text-yellow-900">Ubah</a>
                                        <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>