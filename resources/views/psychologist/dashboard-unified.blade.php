<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Klien & Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Manajemen Klien & Jadwal Anda</h3>

                <div x-data="{ activeTab: 'appointments' }" class="w-full">
                    <!-- Tabs -->
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button @click="activeTab = 'appointments'" :class="{ 'border-blue-500 text-blue-600': activeTab === 'appointments', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'appointments' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Janji Temu Saya
                            </button>
                            <button @click="activeTab = 'schedules'" :class="{ 'border-blue-500 text-blue-600': activeTab === 'schedules', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'schedules' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Jadwal Ketersediaan
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="mt-6">
                        <div x-show="activeTab === 'appointments'">
                            @include('appointments._index_content', ['appointments' => $appointments])
                        </div>
                        <div x-show="activeTab === 'schedules'">
                            @include('schedules._index_content', ['schedules' => $schedules])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>