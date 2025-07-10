<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pertanyaan untuk Kuis: ') }} {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4">{{ $quiz->title }}</h3>
                    <p class="text-gray-600 mb-6">{{ $quiz->description }}</p>

                    <a href="{{ route('admin.quizzes.questions.create', $quiz) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Tambah Pertanyaan Baru
                    </a>

                    <h4 class="text-xl font-semibold mt-8 mb-4">Pertanyaan</h4>
                    @forelse ($quiz->questions as $question)
                        <div class="border p-4 rounded-lg mb-4">
                            <p class="font-semibold">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                            <ul class="list-disc ml-6 mt-2">
                                @foreach ($question->answers as $answer)
                                    <li>{{ $answer->answer_text }} (Skor: {{ $answer->score }})</li>
                                @endforeach
                            </ul>
                            <div class="mt-4 flex space-x-2">
                                <a href="{{ route('admin.quizzes.questions.edit', ['quiz' => $quiz, 'question' => $question]) }}" class="text-yellow-600 hover:text-yellow-900 text-sm">Ubah Pertanyaan</a>
                                <form action="{{ route('admin.quizzes.questions.destroy', ['quiz' => $quiz, 'question' => $question]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus Pertanyaan</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada pertanyaan ditambahkan.</p>
                    @endforelse

                    <div class="mt-6">
                        <a href="{{ route('admin.quizzes.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali ke Daftar Kuis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>