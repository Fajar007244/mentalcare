<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Rekam Medis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Formulir Edit Rekam Medis</h3>

                <form action="{{ route('patient-records.update', $patientRecord) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="patient_id" class="block font-medium text-sm text-gray-700">Pilih Pasien</label>
                        <select name="patient_id" id="patient_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">-- Pilih Pasien --</option>
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id', $patientRecord->patient_id) == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="record_date" class="block font-medium text-sm text-gray-700">Tanggal Catatan</label>
                        <input type="date" name="record_date" id="record_date" value="{{ old('record_date', $patientRecord->record_date->format('Y-m-d')) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('record_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="title" class="block font-medium text-sm text-gray-700">Judul Catatan</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $patientRecord->title) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block font-medium text-sm text-gray-700">Isi Catatan</label>
                        <textarea name="content" id="content" rows="8" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('content', $patientRecord->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Perbarui Catatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
