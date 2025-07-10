<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Detail Jadwal</h3>

                <div class="space-y-4 text-gray-700">
                    <p><span class="font-semibold">Waktu Mulai:</span> {{ \Carbon\Carbon::parse($schedule->start_time)->translatedFormat('l, d F Y H:i') }} WIB</p>
                    <p><span class="font-semibold">Waktu Selesai:</span> {{ \Carbon\Carbon::parse($schedule->end_time)->translatedFormat('l, d F Y H:i') }} WIB</p>
                    <p><span class="font-semibold">Harga:</span> Rp{{ number_format($schedule->price, 2, ',', '.') }}</p>
                    <p><span class="font-semibold">Status:</span> 
                        <span class="px-2 py-1 rounded-full text-sm font-medium 
                            {{ $schedule->is_booked ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}
                        ">
                            {{ $schedule->is_booked ? 'Dipesan' : 'Tersedia' }}
                        </span>
                    </p>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('schedules.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Kembali ke Daftar Jadwal
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
