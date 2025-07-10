<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    @can('access-admin-dashboard')
                        <a href="{{ route('courses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Buat Kursus Baru
                        </a>
                    @endcan
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                        @forelse ($courses as $course)
                            <div class="bg-gray-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $course->title }}</h3>
                                <p class="text-gray-700 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('courses.show', $course) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                        Lihat Kursus
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                        </svg>
                                    </a>
                                    @can('access-admin-dashboard')
                                        <div class="flex space-x-2">
                                            <a href="{{ route('courses.edit', $course) }}" class="text-yellow-600 hover:text-yellow-900 text-sm">Ubah</a>
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Tidak ada kursus tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>