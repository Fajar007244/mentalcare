
<div class="p-6 lg:p-8 bg-white border-b border-gray-200 rounded-lg shadow-md">
    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Selamat Datang di Dasbor Admin, {{ Auth::user()->name }}!
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        Gunakan alat di bawah ini untuk mengelola konten, pengguna, dan pengaturan sistem.
    </p>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Card: Manajemen Konten -->
        <div class="bg-blue-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m-1.5 12.75h1.5m-1.5 0a3.375 3.375 0 0 1-3.375-3.375V9.75m12 0a3.375 3.375 0 0 0 3.375-3.375V6.75m-1.5 0a3.375 3.375 0 0 0-3.375-3.375H8.25" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-blue-800 mb-2">Manajemen Konten</h3>
            <p class="text-gray-700 text-sm mb-4">Atur kursus, kuis, dan moderasi forum yang tersedia di platform untuk pengguna.</p>
            <a href="{{ route('admin.content.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                Kelola Konten
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Card: Manajemen Pengguna -->
        <div class="bg-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-green-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m-7.512 2.72a3 3 0 0 1-4.682-2.72M12 18.72V4.512A9.094 9.094 0 0 1 12 4.5m0 14.22a9.094 9.094 0 0 0-3.741-.479m0 0a3 3 0 0 1 4.682-2.72M3.741 15.866a9.094 9.094 0 0 1 0-1.942 3 3 0 0 1 4.682-2.72m0 0a9.094 9.094 0 0 0 3.741-.479m0 0a3 3 0 0 0 4.682 2.72m-7.512-2.72a3 3 0 0 0-4.682 2.72" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-green-800 mb-2">Verifikasi Psikolog</h3>
            <p class="text-gray-700 text-sm mb-4">Tinjau dan setujui pendaftaran para psikolog profesional.</p>
            <a href="{{ route('admin.psychologists.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                Lihat Daftar
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Card: Statistik Pengguna -->
        <div class="bg-purple-100 p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 h-12 bg-purple-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-purple-800 mb-2">Statistik Pengguna</h3>
            <ul class="text-sm text-gray-700 space-y-1">
                @forelse($userCounts as $role => $count)
                    <li><span class="font-medium">{{ ucfirst($role) }}:</span> {{ $count }}</li>
                @empty
                    <li>Data tidak tersedia.</li>
                @endforelse
            </ul>
        </div>

    </div>
</div>
