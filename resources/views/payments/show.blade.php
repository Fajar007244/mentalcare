<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Detail Tagihan</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                        <div>
                            <p class="font-semibold">Psikolog:</p>
                            <p>{{ $payment->appointment->psychologist->name }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Jadwal Konsultasi:</p>
                            <p>{{ $payment->appointment->appointment_time->translatedFormat('l, d F Y H:i') }} WIB</p>
                        </div>
                        <div>
                            <p class="font-semibold">Status Tagihan:</p>
                            <p>
                                <span @class([
                                    'px-3 py-1 text-sm font-semibold rounded-full',
                                    'bg-yellow-100 text-yellow-800' => $payment->status === 'pending',
                                    'bg-green-100 text-green-800' => $payment->status === 'completed',
                                ])>
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="md:col-span-2 border-t pt-4 mt-4">
                            <p class="text-xl font-bold text-gray-900 flex justify-between items-center">
                                <span>Total Pembayaran:</span>
                                <span class="text-blue-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>

                    @if ($payment->status == 'pending')
                        <div class="mt-8 text-center">
                            <p class="text-gray-600 mb-4">Untuk melanjutkan, silakan konfirmasi pembayaran Anda.</p>
                            <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="confirm_payment">
                                <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Konfirmasi & Bayar Sekarang
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="mt-8 p-4 bg-green-50 border border-green-200 rounded-lg text-center">
                            <p class="text-green-800 font-semibold">Pembayaran ini telah berhasil.</p>
                            <a href="{{ route('appointments.show', $payment->appointment_id) }}" class="mt-2 inline-block text-blue-600 hover:underline">Lihat Detail Janji Temu</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>