<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Rekam Medis Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Formulir Rekam Medis Baru</h3>

                <form action="{{ route('patient-records.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="appointment_id" class="block font-medium text-sm text-gray-700">Pilih Sesi Janji Temu</label>
                        <select name="appointment_id" id="appointment_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">-- Pilih Sesi Janji Temu --</option>
                            @foreach ($confirmedAppointments as $appointment)
                                <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                    {{ $appointment->appointment_time->format('d M Y H:i') }} - {{ $appointment->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('appointment_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="record_date" class="block font-medium text-sm text-gray-700">Tanggal Catatan</label>
                        <input type="date" name="record_date" id="record_date" value="{{ old('record_date', date('Y-m-d')) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('record_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="title" class="block font-medium text-sm text-gray-700">Judul Catatan</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block font-medium text-sm text-gray-700">Isi Catatan</label>
                        <textarea name="content" id="content" rows="8" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Simpan Catatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
