<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rekam Medis Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Daftar Rekam Medis</h3>
                    <a href="{{ route('patient-records.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Tambah Rekam Medis Baru
                    </a>
                </div>

                @forelse ($patientRecords as $record)
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-4 border border-gray-200">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-xl font-semibold text-gray-800">
                                {{ $record->title }}
                            </h4>
                            <span class="text-sm text-gray-600">Tanggal: {{ \Carbon\Carbon::parse($record->record_date)->translatedFormat('d F Y') }}</span>
                        </div>
                        <p class="text-gray-700 mb-2">
                            <span class="font-medium">Pasien:</span> {{ $record->patient->name }}
                        </p>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $record->content }}</p>

                        <div class="flex space-x-2">
                            <a href="{{ route('patient-records.show', $record) }}" class="inline-flex items-center px-3 py-1 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Lihat Detail
                            </a>
                            <a href="{{ route('patient-records.edit', $record) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 focus:outline-none focus:border-yellow-600 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </a>
                            <form action="{{ route('patient-records.destroy', $record) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan medis ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center text-gray-600">
                        Belum ada rekam medis pasien yang ditemukan.
                    </div>
                @endforelse

                <div class="mt-6">
                    {{ $patientRecords->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
