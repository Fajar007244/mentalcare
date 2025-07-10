<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jurnal Suasana Hatiku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <a href="{{ route('mood-entries.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Tambah Catatan Suasana Hati
                    </a>

                    <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Grafik Perubahan Suasana Hati</h3>
                        <canvas id="moodChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const ctx = document.getElementById('moodChart').getContext('2d');
                            const moodDates = @json($moodDates);
                            const moodScores = @json($moodScores);

                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: moodDates,
                                    datasets: [{
                                        label: 'Skor Suasana Hati',
                                        data: moodScores,
                                        borderColor: 'rgb(75, 192, 192)',
                                        tension: 0.1,
                                        fill: false
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            max: 5,
                                            ticks: {
                                                stepSize: 1
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>

                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Skor Suasana Hati (1-5)</th>
                                <th class="px-4 py-2">Catatan</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($moodEntries as $entry)
                                <tr>
                                    <td class="border px-4 py-2">{{ $entry->entry_date->format('Y-m-d') }}</td>
                                    <td class="border px-4 py-2">{{ $entry->mood_score }}</td>
                                    <td class="border px-4 py-2">{{ Str::limit($entry->notes, 50) }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('mood-entries.show', $entry) }}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                        <a href="{{ route('mood-entries.edit', $entry) }}" class="text-yellow-600 hover:text-yellow-900">Ubah</a>
                                        <form action="{{ route('mood-entries.destroy', $entry) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border px-4 py-2 text-center">Tidak ada catatan suasana hati yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
