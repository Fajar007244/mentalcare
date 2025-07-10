<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Janji Temu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Edit Detail Janji Temu</h3>

                <form action="{{ route('appointments.update', $appointment) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @if(Auth::user()->isPsychologist() || Auth::user()->isAdmin())
                        <div class="mb-4">
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="status" id="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="pending" @selected(old('status', $appointment->status) == 'pending')>Menunggu</option>
                                <option value="confirmed" @selected(old('status', $appointment->status) == 'confirmed')>Dikonfirmasi</option>
                                <option value="completed" @selected(old('status', $appointment->status) == 'completed')>Selesai</option>
                                <option value="cancelled" @selected(old('status', $appointment->status) == 'cancelled')>Dibatalkan</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="meeting_link" class="block font-medium text-sm text-gray-700">Tautan Rapat</label>
                            <input type="url" name="meeting_link" id="meeting_link" value="{{ old('meeting_link', $appointment->meeting_link) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('meeting_link')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="block font-medium text-sm text-gray-700">Catatan</label>
                            <textarea name="notes" id="notes" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('notes', $appointment->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @else {{-- User Biasa --}}
                        <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800">
                            <p class="font-semibold">Anda hanya dapat membatalkan janji temu ini.</p>
                            <p class="text-sm">Untuk perubahan lain, silakan hubungi psikolog Anda.</p>
                        </div>
                        <input type="hidden" name="status" value="cancelled">
                    @endif

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Perbarui Janji Temu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>