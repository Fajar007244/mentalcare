<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tes Kesehatan Mental') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Pilih Tes yang Tersedia</h3>
                <p class="text-gray-600 mb-8">Pilih salah satu tes di bawah ini untuk memulai. Ingat, hasil tes ini bukanlah diagnosis medis, melainkan alat bantu untuk refleksi diri dan pemahaman awal.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @if (!is_array($quizzes) && !is_object($quizzes))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Error Data Kuis!</strong>
                            <span class="block sm:inline">Data kuis tidak valid. Tipe data: {{ gettype($quizzes) }}.</span>
                        </div>
                    @else
                        @foreach ($quizzes as $quiz)
                            <div class="bg-secondary-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 bg-secondary-500 text-white rounded-full mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m-4.5 4.5H12a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.133-.64-2.105-1.696-2.625l-1.353-.677A2.25 2.25 0 0 0 9.108 2.25H7.5A2.25 2.25 0 0 0 5.25 4.5v15A2.25 2.25 0 0 0 7.5 21.75h1.5m4.5-1.5h3.75m-4.5 0a3 3 0 0 0-3-3H5.25m12.75-3h3.75m-4.5 0a3 3 0 0 0-3-3H5.25m12.75-3h3.75m-4.5 0a3 3 0 0 0-3-3H5.25M12 21.75V4.721c0-.426.072-.84.207-1.236l.506-1.215a.75.75 0 0 1 1.15-.47l.506 1.215c.135.396.207.81.207 1.236V21.75" />
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-semibold text-secondary-800">{{ $quiz->title }}</h4>
                                    <p class="text-gray-700 text-sm mt-2 mb-4 flex-grow">{{ $quiz->description }}</p>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('quizzes.start', $quiz) }}" class="inline-flex items-center text-secondary-600 hover:text-secondary-800 font-medium">
                                        Mulai Tes
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
