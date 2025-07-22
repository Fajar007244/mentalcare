<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MentalCare - Dukungan Kesehatan Mental Anda</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-secondary-50 text-gray-800 antialiased">
        <!-- Header -->
        <header class="bg-white/80 backdrop-blur-md fixed top-0 left-0 right-0 z-50 shadow-sm">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a href="#" class="text-2xl font-bold text-primary-500">MentalCare</a>
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="#fitur" class="text-gray-600 hover:text-primary-500 transition-all duration-300 transform hover:scale-110">Fitur</a>
                    <a href="#testimoni" class="text-gray-600 hover:text-primary-500 transition-all duration-300 transform hover:scale-110">Testimoni</a>
                    <a href="#kontak" class="text-gray-600 hover:text-primary-500 transition-all duration-300 transform hover:scale-110">Kontak</a>
                </nav>
                <div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-primary-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-primary-600 transition-transform transform hover:scale-105">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-500 transition-colors mr-4">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-primary-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-primary-600 transition-transform transform hover:scale-105">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <main>
            <!-- Hero Section -->
            <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-28 bg-white overflow-hidden">
                <div class="container mx-auto px-6 text-center z-10 relative">
                    <h2 class="text-4xl lg:text-6xl font-bold text-primary-500 mb-4 leading-tight">Kesehatan Mental Anda adalah Prioritas</h2>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">Temukan ruang aman untuk berbagi, belajar, dan bertumbuh bersama para ahli dan komunitas yang peduli.</p>
                    <a href="{{ route('register') }}" class="bg-secondary-500 text-white font-bold py-3 px-8 rounded-full hover:bg-secondary-600 transition-transform transform hover:scale-105 shadow-lg">Mulai Perjalanan Anda</a>
                </div>
                <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-secondary-100 rounded-full opacity-50"></div>
                <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary-500/10 rounded-full opacity-50"></div>
            </section>

            <!-- Features Section -->
            <section id="fitur" class="py-20 bg-secondary-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-12">
                        <h3 class="text-3xl font-bold text-primary-500">Solusi Terpadu untuk Anda</h3>
                        <p class="text-gray-600 mt-2">Kami menyediakan semua yang Anda butuhkan untuk merasa lebih baik.</p>
                    </div>
                    <div class="flex flex-wrap -mx-4">
                        <!-- Feature 1 -->
                        <div class="w-full md:w-1/3 px-4 mb-8">
                            <div class="bg-white rounded-lg shadow-lg p-8 text-center h-full transform hover:-translate-y-2 transition-transform">
                                <div class="mb-4 inline-block p-4 rounded-full bg-secondary-100">
                                    <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 5.523-4.477 10-10 10S1 17.523 1 12 5.477 2 11 2s10 4.477 10 10z"></path></svg>
                                </div>
                                <h4 class="text-xl font-bold mb-2 text-primary-500">Konsultasi Online</h4>
                                <p class="text-gray-600">Sesi privat dengan psikolog berlisensi, kapan pun dan di mana pun Anda butuhkan.</p>
                            </div>
                        </div>
                        <!-- Feature 2 -->
                        <div class="w-full md:w-1/3 px-4 mb-8">
                            <div class="bg-white rounded-lg shadow-lg p-8 text-center h-full transform hover:-translate-y-2 transition-transform">
                                <div class="mb-4 inline-block p-4 rounded-full bg-secondary-100">
                                    <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </div>
                                <h4 class="text-xl font-bold mb-2 text-primary-500">Tes Psikologi</h4>
                                <p class="text-gray-600">Kenali diri Anda lebih dalam melalui serangkaian tes psikologi terstandarisasi.</p>
                            </div>
                        </div>
                        <!-- Feature 3 -->
                        <div class="w-full md:w-1/3 px-4 mb-8">
                            <div class="bg-white rounded-lg shadow-lg p-8 text-center h-full transform hover:-translate-y-2 transition-transform">
                                <div class="mb-4 inline-block p-4 rounded-full bg-secondary-100">
                                    <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <h4 class="text-xl font-bold mb-2 text-primary-500">Forum Komunitas</h4>
                                <p class="text-gray-600">Bergabunglah dalam komunitas yang suportif untuk berbagi cerita dan saling menguatkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonial Section -->
            <section id="testimoni" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-12">
                        <h3 class="text-3xl font-bold text-primary-500">Apa Kata Mereka?</h3>
                        <p class="text-gray-600 mt-2">Kisah nyata dari para pengguna yang telah merasakan manfaatnya.</p>
                    </div>
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <div class="bg-secondary-50 rounded-lg p-6 h-full">
                                <p class="text-gray-600 italic mb-4">"MentalCare benar-benar mengubah hidup saya. Saya merasa lebih didengar dan dipahami. Terima kasih!"</p>
                                <p class="font-bold text-primary-500">- Pengguna A</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <div class="bg-secondary-50 rounded-lg p-6 h-full">
                                <p class="text-gray-600 italic mb-4">"Awalnya ragu, tapi psikolog di sini sangat profesional dan membantu saya melihat masalah dari sudut pandang baru."</p>
                                <p class="font-bold text-primary-500">- Pengguna B</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                            <div class="bg-secondary-50 rounded-lg p-6 h-full">
                                <p class="text-gray-600 italic mb-4">"Fitur tesnya sangat menarik dan akurat. Saya jadi lebih mengenal diri sendiri."</p>
                                <p class="font-bold text-primary-500">- Pengguna C</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section id="kontak" class="bg-primary-500 text-white">
                <div class="container mx-auto px-6 py-20 text-center">
                    <h3 class="text-3xl font-bold mb-4">Siap Mengambil Langkah Pertama?</h3>
                    <p class="text-lg mb-8 max-w-2xl mx-auto">Kesehatan mental adalah perjalanan, bukan tujuan. Kami siap menemani setiap langkah Anda.</p>
                    <a href="{{ route('register') }}" class="bg-white text-primary-500 font-bold py-3 px-8 rounded-full hover:bg-secondary-100 transition-transform transform hover:scale-105 shadow-lg">Daftar Gratis Sekarang</a>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white">
            <div class="container mx-auto px-6 py-10">
                <div class="flex flex-wrap justify-between">
                    <div class="w-full md:w-1/3 mb-6 md:mb-0">
                        <h4 class="text-xl font-bold mb-2">MentalCare</h4>
                        <p class="text-gray-400">Dukungan kesehatan mental dalam genggaman Anda.</p>
                    </div>
                    <div class="w-full md:w-1/3 mb-6 md:mb-0">
                        <h5 class="font-bold mb-2">Tautan</h5>
                        <ul>
                            <li><a href="#" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div class="w-full md:w-1/3">
                        <h5 class="font-bold mb-2">Kontak</h5>
                        <p class="text-gray-400">Email: support@mentalcare.com</p>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                    <p class="text-gray-500">&copy; 2025 MentalCare. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>