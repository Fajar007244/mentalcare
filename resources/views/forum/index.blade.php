<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forum Diskusi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-medium text-gray-900">
                            Semua Topik Diskusi
                        </h1>
                        <a href="{{ route('forum.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Buat Topik Baru
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse ($posts as $post)
                            <div class="p-4 border rounded-lg hover:bg-gray-50">
                                <a href="{{ route('forum.show', $post) }}" class="block">
                                    <h3 class="text-lg font-semibold text-indigo-600 hover:text-indigo-800">{{ $post->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Ditulis oleh {{ $post->user->name }} - <span class="text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                                    </p>
                                </a>
                                @can('delete', $post)
                                    <form action="{{ route('forum.destroy', $post->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada topik diskusi.</p>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
