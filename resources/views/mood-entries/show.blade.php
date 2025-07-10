<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Catatan Suasana Hati') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4">Catatan Suasana Hati untuk {{ $moodEntry->entry_date->format('Y-m-d') }}</h3>
                    <p class="text-lg mb-2">Skor Suasana Hati: <span class="font-bold">{{ $moodEntry->mood_score }}</span></p>
                    <p class="text-lg mb-2">Catatan: {{ $moodEntry->notes }}</p>

                    <div class="mt-6">
                        <a href="{{ route('mood-entries.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali ke Jurnal Suasana Hati</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
