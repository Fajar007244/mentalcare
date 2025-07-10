<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Judul</label>
                            <input type="text" name="title" id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                            <textarea name="description" id="description" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>

                        <div class="mt-4">
                            <label for="content_type" class="block font-medium text-sm text-gray-700">Tipe Konten</label>
                            <select name="content_type" id="content_type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="video">Video</option>
                                <option value="pdf">PDF</option>
                                <option value="podcast">Podcast</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="content_path" class="block font-medium text-sm text-gray-700">Jalur Konten (URL atau Jalur File)</label>
                            <input type="text" name="content_path" id="content_path" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Buat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>