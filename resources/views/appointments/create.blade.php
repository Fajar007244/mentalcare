<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Janji Temu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Pesan Janji Temu dengan Psikolog</h3>

                <!-- Filter Section -->
                <form id="filterForm" action="{{ route('appointments.create') }}" method="GET" class="mb-8 p-6 bg-gray-50 rounded-lg shadow-sm border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                        <div>
                            <label for="psychologist_id" class="block font-medium text-sm text-gray-700">Pilih Psikolog</label>
                            <select name="psychologist_id" id="psychologist_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                <option value="">Semua Psikolog</option>
                                @foreach ($psychologists as $psychologist)
                                    <option value="{{ $psychologist->id }}" {{ request('psychologist_id') == $psychologist->id ? 'selected' : '' }}>
                                        {{ $psychologist->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-700 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Filter Jadwal
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Calendar Section -->
                <div id='calendar' class="p-4 border border-gray-200 rounded-lg shadow-md"></div>

                <form id="appointmentForm" action="{{ route('appointments.store') }}" method="POST" class="mt-8 p-6 bg-white border border-gray-200 rounded-lg shadow-md" style="display: none;">
                    @csrf
                    <input type="hidden" name="schedule_id" id="selected_schedule_id">
                    <div class="mb-4">
                        <p class="text-lg text-gray-800 font-semibold mb-3">Konfirmasi Janji Temu Anda</p>
                        <div id="selectedScheduleInfo" class="space-y-2 text-gray-700">
                            <!-- Details will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-secondary-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-secondary-700 active:bg-secondary-900 focus:outline-none focus:border-secondary-700 focus:ring ring-secondary-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Konfirmasi Janji Temu
                        </button>
                    </div>
                </form>

                @error('schedule_id')
                    <p class="text-red-500 text-xs mt-4">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'id',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: [
                        @foreach($availableSchedules as $schedule)
                            {
                                id: '{{ $schedule->id }}',
                                title: '{{ $schedule->user->name }} - Rp{{ number_format($schedule->price, 0, ',', '.') }}',
                                start: '{{ $schedule->start_time->format('Y-m-d H:i:s') }}',
                                end: '{{ $schedule->end_time->format('Y-m-d H:i:s') }}',
                                extendedProps: {
                                    psychologist: '{{ $schedule->user->name }}',
                                    price: 'Rp{{ number_format($schedule->price, 0, ',', '.') }}',
                                    is_booked: {{ $schedule->is_booked ? 'true' : 'false' }}
                                },
                                className: 'cursor-pointer',
                                color: '{{ $schedule->is_booked ? '#ef4444' : '#4caf50' }}' // Red for booked, green for available
                            },
                        @endforeach
                    ],
                    eventClick: function(info) {
                        if (!info.event.extendedProps.is_booked) {
                            document.getElementById('selected_schedule_id').value = info.event.id;
                            const scheduleInfoDiv = document.getElementById('selectedScheduleInfo');
                            scheduleInfoDiv.innerHTML = `
                                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <p><span class="font-semibold">Psikolog:</span> ${info.event.extendedProps.psychologist}</p>
                                    <p><span class="font-semibold">Waktu:</span> ${new Date(info.event.start).toLocaleString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })} - ${new Date(info.event.end).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })} WIB</p>
                                    <p class="mt-2 text-lg font-bold text-primary-600"><span class="font-semibold">Harga:</span> ${info.event.extendedProps.price}</p>
                                </div>
                            `;
                            document.getElementById('appointmentForm').style.display = 'block';
                        } else {
                            alert('Jadwal ini sudah dipesan.');
                        }
                    },
                    eventDidMount: function(info) {
                        // Add custom styling for events
                        info.el.style.padding = '4px 6px';
                        info.el.style.borderRadius = '4px';
                        info.el.style.fontSize = '0.75rem';
                        info.el.style.fontWeight = '600';
                        info.el.style.whiteSpace = 'normal';
                        info.el.style.lineHeight = '1.2';
                    }
                });
                calendar.render();

                // Re-render calendar when filters change
                document.getElementById('filterForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const psychologistId = document.getElementById('psychologist_id').value;
                    
                    // Construct new URL with filters
                    const url = new URL(window.location.href);
                    url.searchParams.set('psychologist_id', psychologistId);
                    // Remove date parameter as it's now handled by calendar navigation
                    url.searchParams.delete('date'); 
                    window.location.href = url.toString(); // Reload page with new filters
                });
            });
        </script>
    @endpush
</x-app-layout>