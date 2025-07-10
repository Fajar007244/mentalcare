<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="text-2xl font-bold text-gray-900 mb-6">
                    @if(Auth::user()->role === 'psychologist')
                        Pendapatan Anda
                    @else
                        Tagihan Anda
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Janji Temu</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                @if(Auth::user()->role === 'psychologist')
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klien</th>
                                @else
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Psikolog</th>
                                @endif
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($payments as $payment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $payment->appointment_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->created_at->translatedFormat('d F Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if(Auth::user()->role === 'psychologist')
                                            {{ $payment->user->name }}
                                        @else
                                            {{ $payment->appointment->psychologist->name }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span @class([
                                            'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                            'bg-yellow-100 text-yellow-800' => $payment->status === 'pending',
                                            'bg-green-100 text-green-800' => $payment->status === 'completed',
                                            'bg-red-100 text-red-800' => $payment->status === 'failed',
                                        ])>
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($payment->status === 'pending' && Auth::user()->role !== 'psychologist')
                                            <a href="{{ route('payments.show', $payment->id) }}" class="text-indigo-600 hover:text-indigo-900">Bayar Sekarang</a>
                                        @elseif(Auth::user()->role === 'psychologist' && $payment->status === 'completed')
                                            <span class="text-green-600">Diterima</span>
                                        @else
                                            <a href="{{ route('appointments.show', $payment->appointment_id) }}" class="text-gray-600 hover:text-gray-900">Lihat Detail</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        Tidak ada data pembayaran ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $payments->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>