<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Rekam Medis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $patientRecord->title }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg text-gray-700 mb-6">
                    <div>
                        <p><span class="font-semibold">Pasien:</span> {{ $patientRecord->patient->name }}</p>
                        <p><span class="font-semibold">Psikolog:</span> {{ $patientRecord->psychologist->name }}</p>
                    </div>
                    <div>
                        <p><span class="font-semibold">Tanggal Catatan:</span> {{ \Carbon\Carbon::parse($patientRecord->record_date)->translatedFormat('l, d F Y') }}</p>
                        <p><span class="font-semibold">Dibuat Pada:</span> {{ \Carbon\Carbon::parse($patientRecord->created_at)->translatedFormat('l, d F Y H:i') }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                    <h4 class="font-semibold text-xl text-gray-800 mb-3">Isi Catatan</h4>
                    <div class="prose max-w-none">
                        <p>{{ $patientRecord->content }}</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('patient-records.edit', $patientRecord) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 focus:outline-none focus:border-yellow-600 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Edit Catatan
                    </a>
                    <form action="{{ route('patient-records.destroy', $patientRecord) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan medis ini?')">
                            Hapus Catatan
                        </button>
                    </form>
                    <a href="{{ route('patient-records.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
