<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hasil Tes: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg text-center">
                <div class="p-6 lg:p-8 bg-white">
                    <h3 class="text-2xl font-bold text-gray-800">Hasil Analisis Anda</h3>
                    <p class="mt-2 text-gray-600">Berdasarkan jawaban yang Anda berikan:</p>
                    
                    <div class="my-8">
                        <div class="inline-block bg-blue-500 rounded-full p-2">
                            <div class="w-40 h-40 rounded-full bg-white flex items-center justify-center shadow-inner">
                                <div class="text-center">
                                    <span class="text-lg text-gray-500">Total Skor</span>
                                    <p class="text-6xl font-bold text-blue-600">{{ $attempt->score }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-2xl mx-auto">
                        <div class="p-6 bg-blue-50 border border-blue-200 rounded-lg">
                            <h4 class="font-semibold text-xl text-blue-800">Interpretasi Skor</h4>
                            <p class="mt-2 text-gray-700 text-lg">{{ $attempt->result_summary }}</p>
                        </div>
                    </div>

                    <div class="mt-8 max-w-2xl mx-auto">
                        <p class="text-sm text-gray-500"><b>Penting:</b> Hasil ini bukan diagnosis medis. Ini adalah alat skrining yang dapat membantu Anda memahami gejala yang Anda alami. Untuk diagnosis yang akurat, silakan berkonsultasi dengan profesional kesehatan mental.</p>
                        
                        <div class="mt-6 flex flex-col sm:flex-row sm:justify-center gap-4">
                            <a href="{{ route('appointments.create') }}" class="inline-flex justify-center items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Buat Janji Temu
                            </a>
                            <a href="{{ route('quizzes.index') }}" class="inline-flex justify-center items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-sm text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Kembali ke Daftar Tes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
