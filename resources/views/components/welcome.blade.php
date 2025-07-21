<div class="p-6 lg:p-8 bg-white border-b border-gray-200 rounded-lg shadow-md">
    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Selamat Datang di Dashboard MentalCare!
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        Ini adalah pusat kendali Anda untuk mengakses semua fitur dan layanan MentalCare. Pilih salah satu opsi di bawah untuk memulai.
    </p>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card: Tes Kesehatan Mental -->
        <div class="bg-secondary-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-secondary-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m-4.5 4.5H12a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.133-.64-2.105-1.696-2.625l-1.353-.677A2.25 2.25 0 0 0 9.108 2.25H7.5A2.25 2.25 0 0 0 5.25 4.5v15A2.25 2.25 0 0 0 7.5 21.75h1.5m4.5-1.5h3.75m-4.5 0a3 3 0 0 0-3-3H5.25m12.75-3h3.75m-4.5 0a3 3 0 0 0-3-3H5.25m12.75-3h3.75m-4.5 0a3 3 0 0 0-3-3H5.25M12 21.75V4.721c0-.426.072-.84.207-1.236l.506-1.215a.75.75 0 0 1 1.15-.47l.506 1.215c.135.396.207.81.207 1.236V21.75" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-secondary-800 mb-2">Tes Kesehatan Mental</h3>
            <p class="text-gray-700 text-sm mb-4">Akses tes untuk memahami kondisi mental Anda.</p>
            <a href="{{ route('quizzes.index') }}" class="inline-flex items-center text-secondary-600 hover:text-secondary-800 font-medium">
                Mulai Tes
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Card: Kursus Online -->
        <div class="bg-secondary-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-secondary-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-secondary-800 mb-2">Kursus Online</h3>
            <p class="text-gray-700 text-sm mb-4">Tingkatkan pemahaman Anda tentang kesehatan mental melalui berbagai kursus interaktif.</p>
            <a href="#" class="inline-flex items-center text-secondary-600 hover:text-secondary-800 font-medium">
                Lihat Kursus
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Card: Janji Temu Psikolog -->
        <div class="bg-blue-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75M3 18.75V21M21 18.75V21M12 10.5h.008v.008H12v-.008ZM12 14.25h.008v.008H12v-.008ZM12 18h.008v.008H12v-.008Z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-blue-800 mb-2">Janji Temu Psikolog</h3>
            <p class="text-gray-700 text-sm mb-4">Jadwalkan sesi konsultasi pribadi dengan psikolog profesional.</p>
            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                Buat Janji
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Card: Jurnal Mood -->
        <div class="bg-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-green-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m-4.5 4.5H12a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.133-.64-2.105-1.696-2.625l-1.353-.677A2.25 2.25 0 0 0 9.108 2.25H7.5A2.25 2.25 0 0 0 5.25 4.5v15A2.25 2.25 0 0 0 7.5 21.75h1.5m4.5-1.5h3.75m-4.5 0a3 3 0 0 0-3-3H5.25m12.75-3h3.75m-4.5 0a3 3 0 0 0-3-3H5.25m12.75-3h3.75m-4.5 0a3 3 0 0 0-3-3H5.25M12 21.75V4.721c0-.426.072-.84.207-1.236l.506-1.215a.75.75 0 0 1 1.15-.47l.506 1.215c.135.396.207.81.207 1.236V21.75" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-green-800 mb-2">Jurnal Mood</h3>
            <p class="text-gray-700 text-sm mb-4">Catat dan lacak perubahan suasana hati Anda untuk memahami pola emosi.</p>
            <a href="#" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                Isi Jurnal
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Card: Forum Diskusi -->
        <div class="bg-purple-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-purple-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6.174 3.19.504 4.72-1.09-.95-1.998-2.12-2.574-3.417M12 18.827c1.195 1.042 2.507 1.873 3.903 2.407 1.045.383 2.087.647 3.047.785A3.002 3.002 0 0 0 21.75 18V4.75c0-.83-.67-1.5-1.5-1.5h-15c-.83 0-1.5.67-1.5 1.5v10.5c0 .83.67 1.5 1.5 1.5h.75m-1.5 0h-.75m7.5-10.5H12m3.75 0H12m-9 1.5h.375M9 15.75h.008v.008H9v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-purple-800 mb-2">Forum Diskusi</h3>
            <p class="text-gray-700 text-sm mb-4">Berinteraksi dengan komunitas, berbagi pengalaman, dan dapatkan dukungan.</p>
            <a href="#" class="inline-flex items-center text-purple-600 hover:text-purple-800 font-medium">
                Kunjungi Forum
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- Card: Manajemen Akun -->
        <div class="bg-yellow-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-center w-12 h-12 bg-yellow-500 text-white rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-yellow-800 mb-2">Manajemen Akun</h3>
            <p class="text-gray-700 text-sm mb-4">Perbarui profil Anda, kelola pengaturan, dan lihat riwayat aktivitas.</p>
            <a href="#" class="inline-flex items-center text-yellow-600 hover:text-yellow-800 font-medium">
                Kelola Akun
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</div>
