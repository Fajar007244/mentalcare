<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Formulir Edit Jadwal</h3>

                <form action="{{ route('schedules.update', $schedule) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="start_time" class="block font-medium text-sm text-gray-700">Waktu Mulai</label>
                        <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time', $schedule->start_time->format('Y-m-d\TH:i')) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('start_time')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="end_time" class="block font-medium text-sm text-gray-700">Waktu Selesai</label>
                        <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time', $schedule->end_time->format('Y-m-d\TH:i')) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('end_time')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block font-medium text-sm text-gray-700">Harga (Rp)</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $schedule->price) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Perbarui Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
