<div class="p-6 lg:p-8 bg-white border-b border-gray-200 rounded-lg shadow-md">
    @if(Auth::user()->role === 'psychologist' && !Auth::user()->is_verified)
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Perhatian!</strong>
            <span class="block sm:inline">Akun Anda belum diverifikasi. Beberapa fitur mungkin tidak dapat diakses sampai akun Anda diverifikasi oleh administrator.</span>
        </div>
    @elseif(Auth::user()->role === 'psychologist' && Auth::user()->is_verified)
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Selamat!</strong>
            <span class="block sm:inline">{{ __('Akun Anda telah diverifikasi.') }}</span>
        </div>
    @endif
    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Selamat Datang, Psikolog {{ Auth::user()->name }}!
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        Ini adalah dashboard Anda. Kelola jadwal, sesi konsultasi, dan catatan pasien di sini.
    </p>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Card: Manajemen Klien & Jadwal -->
        <div class="bg-secondary-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-secondary-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h-1.5a3.375 3.375 0 0 1-3.375-3.375V9.75m12 0a3.375 3.375 0 0 0 3.375-3.375V6.75m-1.5 0a3.375 3.375 0 0 0-3.375-3.375H9.75m0 12.75h-1.5a3.375 3.375 0 0 0-3.375-3.375V9.75m12 0a3.375 3.375 0 0 0 3.375-3.375V6.75m-1.5 0a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-secondary-800 mb-2">Manajemen Klien & Jadwal</h3>
            <p class="text-gray-700 text-sm mb-4">Kelola janji temu, catatan sesi, dan jadwal ketersediaan Anda.</p>
            <a href="{{ route('psychologist.dashboard.unified') }}" @if(!Auth::user()->is_verified) onclick="event.preventDefault(); showVerificationModal();" @endif class="inline-flex items-center text-secondary-600 hover:text-secondary-800 font-medium">
                Kelola Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Card: Rekam Medis Digital -->
        <div class="bg-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-green-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h-1.5a3.375 3.375 0 0 1-3.375-3.375V9.75m12 0a3.375 3.375 0 0 0 3.375-3.375V6.75m-1.5 0a3.375 3.375 0 0 0-3.375-3.375H9.75m0 12.75h-1.5a3.375 3.375 0 0 0-3.375-3.375V9.75m12 0a3.375 3.375 0 0 0 3.375-3.375V6.75m-1.5 0a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-green-800 mb-2">Rekam Medis Pasien</h3>
            <p class="text-gray-700 text-sm mb-4">Kelola dan lihat riwayat catatan medis pasien Anda.</p>
            <a href="{{ route('patient-records.index') }}" @if(!Auth::user()->is_verified) onclick="event.preventDefault(); showVerificationModal();" @endif class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                Lihat Rekam Medis
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Card: Sistem Billing -->
        <div class="bg-blue-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.794 2.105 60.07 60.07 0 0 0 2.77-1.515c.781-.445 1.36-1.024 1.36-1.715V4.5c0-1.036-.84-1.875-1.875-1.875h-16.5c-1.035 0-1.875.84-1.875 1.875v11.25c0 .69.579 1.27 1.36 1.715Zm0 0h16.5" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-blue-800 mb-2">Riwayat Pembayaran</h3>
            <p class="text-gray-700 text-sm mb-4">Lihat daftar pembayaran janji temu Anda.</p>
            <a href="{{ route('payments.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                Lihat Riwayat
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Verification Modal -->
<div id="verificationModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
              Akses Ditolak
            </h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">
                Akun Anda belum diverifikasi oleh administrator. Silakan hubungi admin untuk verifikasi agar dapat mengakses fitur ini.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" onclick="hideVerificationModal()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>

<script>
    function showVerificationModal() {
        document.getElementById('verificationModal').classList.remove('hidden');
    }

    function hideVerificationModal() {
        document.getElementById('verificationModal').classList.add('hidden');
    }
</script>
