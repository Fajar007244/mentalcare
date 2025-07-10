<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Dummy Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="appointment_id" class="block font-medium text-sm text-gray-700">Select Unpaid Appointment</label>
                            <select name="appointment_id" id="appointment_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @forelse ($unpaidAppointments as $appointment)
                                    <option value="{{ $appointment->id }}">
                                        {{ $appointment->psychologist->name }} - {{ $appointment->appointment_time->format('Y-m-d H:i') }} (Amount: {{ number_format($appointment->schedule->price, 2) }})
                                    </option>
                                @empty
                                    <option value="" disabled>No unpaid appointments available.</option>
                                @endforelse
                            </select>
                            @error('appointment_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @empty($unpaidAppointments) disabled @endempty>
                                Process Dummy Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
