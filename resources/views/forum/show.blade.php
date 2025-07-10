<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Post Details -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-medium text-gray-900">
                        {{ $post->title }}
                    </h1>
                    <p class="text-sm text-gray-600 mt-1">
                        Ditulis oleh {{ $post->user->name }} - <span class="text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                    </p>
                    @can('delete', $post)
                        <form action="{{ route('forum.destroy', $post->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                                Hapus Postingan
                            </button>
                        </form>
                    @endcan
                    <div class="mt-4 text-gray-800 prose max-w-none">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Komentar</h2>

                <!-- Form to Add Comment -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                    <div class="p-6">
                        <form action="{{ route('forum.comments.store', ['forum' => $post->id]) }}" method="POST">
                            @csrf
                            <div>
                                <label for="content" class="block font-medium text-sm text-gray-700">Tinggalkan Komentar</label>
                                <textarea id="content" name="content" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Kirim Komentar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Existing Comments -->
                <div class="space-y-4">
                    @forelse ($post->comments as $comment)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <p class="text-gray-800">{{ $comment->content }}</p>
                            <p class="text-xs text-gray-500 mt-2">
                                Oleh {{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}
                            </p>
                            @can('delete', $comment)
                                <form action="{{ route('forum.comments.destroy', $comment->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">
                                        Hapus Komentar
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @empty
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <p class="text-gray-500">Belum ada komentar.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
