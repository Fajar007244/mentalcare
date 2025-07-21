<div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-bold text-gray-900">Daftar Janji Temu</h3>
    @if(Auth::user()->isUser())
        <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-700 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
            Buat Janji Temu Baru
        </a>
    @endif
</div>

@forelse ($appointments as $appointment)
    <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-4 border border-gray-200">
        <div class="flex justify-between items-center mb-3">
            <h4 class="text-xl font-semibold text-gray-800">
                @if(Auth::user()->isUser())
                    Dengan Psikolog: {{ $appointment->psychologist->name }}
                @else
                    Klien: {{ $appointment->user->name }}
                @endif
            </h4>
            <span class="px-3 py-1 rounded-full text-sm font-medium 
                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
            ">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>
        <p class="text-gray-600 mb-2">
            <span class="font-medium">Waktu:</span> {{ \Carbon\Carbon::parse($appointment->appointment_time)->translatedFormat('l, d F Y H:i') }} WIB
        </p>
        <p class="text-gray-600 mb-4">
            <span class="font-medium">Durasi:</span> 60 Menit
        </p>

        <div class="flex space-x-2">
            <a href="{{ route('appointments.show', $appointment) }}" class="inline-flex items-center px-3 py-1 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Lihat Detail
            </a>
            @if(Auth::user()->isPsychologist() || Auth::user()->isAdmin())
                <a href="{{ route('appointments.edit', $appointment) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 focus:outline-none focus:border-yellow-600 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Edit Status
                </a>
            @endif
            @if(Auth::user()->isUser() && $appointment->status === 'pending')
                <form action="{{ route('appointments.update', $appointment) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Batalkan
                    </button>
                </form>
            @endif
        </div>
    </div>
@empty
    <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center text-gray-600">
        Belum ada janji temu yang ditemukan.
    </div>
@endforelse

<div class="mt-6">
    {{ $appointments->links() }}
</div>
