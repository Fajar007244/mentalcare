<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Konten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4">Pilih Jenis Konten untuk Dikelola</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Card: Manajemen Kursus -->
                        <div class="bg-blue-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h4 class="text-xl font-semibold text-blue-800 mb-2">Manajemen Kursus</h4>
                            <p class="text-gray-700 text-sm mb-4">Kelola daftar kursus online, termasuk menambah, mengedit, dan menghapus kursus.</p>
                            <a href="{{ route('courses.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                Kelola Kursus
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                </svg>
                            </a>
                        </div>

                        <!-- Card: Manajemen Kuis -->
                        <div class="bg-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h4 class="text-xl font-semibold text-green-800 mb-2">Manajemen Kuis</h4>
                            <p class="text-gray-700 text-sm mb-4">Kelola daftar kuis kesehatan mental, termasuk menambah, mengedit, dan menghapus kuis serta pertanyaan di dalamnya.</p>
                            <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                                Kelola Kuis
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                </svg>
                            </a>
                        </div>

                        <!-- Card: Moderasi Forum -->
                        <div class="bg-purple-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h4 class="text-xl font-semibold text-purple-800 mb-2">Moderasi Forum</h4>
                            <p class="text-gray-700 text-sm mb-4">Kelola postingan dan komentar di forum diskusi.</p>
                            <a href="{{ route('forum.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 font-medium">
                                Kelola Forum
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>