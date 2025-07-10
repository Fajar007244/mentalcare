<div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-bold text-gray-900">Daftar Jadwal Konsultasi</h3>
    <a href="{{ route('schedules.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
        Tambah Jadwal Baru
    </a>
</div>

@forelse ($schedules as $schedule)
    <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-4 border border-gray-200">
        <div class="flex justify-between items-center mb-3">
            <h4 class="text-xl font-semibold text-gray-800">
                Waktu: {{ \Carbon\Carbon::parse($schedule->start_time)->translatedFormat('l, d F Y H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }} WIB
            </h4>
            <span class="px-3 py-1 rounded-full text-sm font-medium 
                {{ $schedule->is_booked ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}
            ">
                {{ $schedule->is_booked ? 'Dipesan' : 'Tersedia' }}
            </span>
        </div>
        <p class="text-gray-600 mb-4">
            <span class="font-medium">Harga:</span> Rp{{ number_format($schedule->price, 2, ',', '.') }}
        </p>

        <div class="flex space-x-2">
            <a href="{{ route('schedules.edit', $schedule) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 focus:outline-none focus:border-yellow-600 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                Edit
            </a>
            <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                    Hapus
                </button>
            </form>
        </div>
    </div>
@empty
    <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center text-gray-600">
        Belum ada jadwal yang ditemukan.
    </div>
@endforelse

<div class="mt-6">
    {{ $schedules->links() }}
</div>
