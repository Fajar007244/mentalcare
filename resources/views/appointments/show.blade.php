<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Janji Temu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Janji Temu dengan {{ $appointment->psychologist->name }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg text-gray-700">
                    <div>
                        <p><span class="font-semibold">Klien:</span> {{ $appointment->user->name }}</p>
                        <p><span class="font-semibold">Waktu:</span> {{ \Carbon\Carbon::parse($appointment->appointment_time)->translatedFormat('l, d F Y H:i') }} WIB</p>
                        <p><span class="font-semibold">Status:</span> <span class="font-medium 
                            {{ $appointment->status === 'pending' ? 'text-yellow-600' : '' }}
                            {{ $appointment->status === 'confirmed' ? 'text-green-600' : '' }}
                            {{ $appointment->status === 'completed' ? 'text-blue-600' : '' }}
                            {{ $appointment->status === 'cancelled' ? 'text-red-600' : '' }}
                        ">{{ ucfirst($appointment->status) }}</span></p>
                    </div>
                    <div>
                        @if($appointment->notes)
                            <p><span class="font-semibold">Catatan:</span> {{ $appointment->notes }}</p>
                        @endif
                        @if($appointment->meeting_link)
                            <p><span class="font-semibold">Tautan Rapat:</span> <a href="{{ $appointment->meeting_link }}" target="_blank" class="text-blue-600 hover:underline">{{ $appointment->meeting_link }}</a></p>
                        @endif
                    </div>
                </div>

                @if($appointment->meeting_link)
                    <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg text-center">
                        <h4 class="text-xl font-semibold text-blue-800 mb-3">Panggilan Video</h4>
                        <button id="startJitsi" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Mulai Panggilan Video
                        </button>
                        <div id="jitsi-container" class="mt-4" style="height: 600px; width: 100%; display: none;"></div>
                    </div>
                    @push('scripts')
                        <script src="https://meet.jit.si/external_api.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const startJitsiButton = document.getElementById('startJitsi');
                                const jitsiContainer = document.getElementById('jitsi-container');
                                let api = null;

                                startJitsiButton.addEventListener('click', function () {
                                    if (api) {
                                        api.dispose();
                                        jitsiContainer.style.display = 'none';
                                        startJitsiButton.textContent = 'Mulai Panggilan Video';
                                    } else {
                                        const domain = 'meet.jit.si';
                                        const roomName = '{{ Str::afterLast($appointment->meeting_link, '/') }}'; // Extract room name from link
                                        const options = {
                                            roomName: roomName,
                                            width: '100%',
                                            height: 600,
                                            parentNode: jitsiContainer,
                                            userInfo: {
                                                displayName: '{{ Auth::user()->name }}'
                                            },
                                            configOverwrite: {
                                                prejoinPageEnabled: false, // Skip the pre-join page
                                                startWithAudioMuted: false,
                                                startWithVideoMuted: false,
                                            },
                                            interfaceConfigOverwrite: {
                                                SHOW_JITSI_WATERMARK: false,
                                                SHOW_WATERMARK_FOR_GUESTS: false,
                                                SHOW_BRAND_WATERMARK: false,
                                                SHOW_POWERED_BY: false,
                                                TOOLBAR_BUTTONS: [
                                                    'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                                                    'fodeviceselection', 'hangup', 'profile', 'chat', 'recording',
                                                    'livestreaming', 'etherpad', 'sharedvideo', 'settings', 'raisehand',
                                                    'videoquality', 'filmstrip', 'feedback', 'stats', 'shortcuts',
                                                    'tileview', 'videobackgroundblur', 'download', 'help', 'mute-everyone',
                                                    'security', 'toggle-camera', 'invite',
                                                ],
                                            },
                                        };
                                        api = new JitsiMeetExternalAPI(domain, options);
                                        jitsiContainer.style.display = 'block';
                                        startJitsiButton.textContent = 'Akhiri Panggilan Video';
                                    }
                                });
                            });
                        </script>
                    @endpush
                @else
                    <div class="mt-8 p-4 bg-gray-100 border border-gray-200 rounded-lg text-center text-gray-600">
                        Tautan video call untuk janji temu ini akan tersedia di sini.
                    </div>
                @endif

                <div class="mt-6 text-center">
                    <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Kembali ke Daftar Janji Temu
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>