<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Pertanyaan untuk Kuis: ') }} {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.quizzes.questions.update', ['quiz' => $quiz, 'question' => $question]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="question_text" class="block font-medium text-sm text-gray-700">Teks Pertanyaan</label>
                            <textarea id="question_text" name="question_text" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('question_text', $question->question_text) }}</textarea>
                            @error('question_text')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <h4 class="text-lg font-semibold mt-6 mb-2">Jawaban</h4>
                        <div id="answers-container">
                            @foreach ($question->answers as $index => $answer)
                                <div class="flex items-center mt-2">
                                    <input type="hidden" name="answers[{{ $index }}][id]" value="{{ $answer->id }}">
                                    <input type="text" name="answers[{{ $index }}][answer_text]" placeholder="Teks Jawaban" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ old('answers.' . $index . '.answer_text', $answer->answer_text) }}" required>
                                    <input type="number" name="answers[{{ $index }}][score]" placeholder="Skor" class="ml-2 w-20 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ old('answers.' . $index . '.score', $answer->score) }}" required>
                                    <button type="button" class="remove-answer ml-2 text-red-600 hover:text-red-900 text-sm">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-answer" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tambah Jawaban Lain
                        </button>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Perbarui Pertanyaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let answerIndex = {{ count($question->answers) }};
            document.getElementById('add-answer').addEventListener('click', function () {
                const container = document.getElementById('answers-container');
                const newAnswerDiv = document.createElement('div');
                newAnswerDiv.className = 'flex items-center mt-2';
                newAnswerDiv.innerHTML = `
                    <input type="text" name="answers[${answerIndex}][answer_text]" placeholder="Teks Jawaban" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <input type="number" name="answers[${answerIndex}][score]" placeholder="Skor" class="ml-2 w-20 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <button type="button" class="remove-answer ml-2 text-red-600 hover:text-red-900 text-sm">Hapus</button>
                `;
                container.appendChild(newAnswerDiv);
                answerIndex++;

                newAnswerDiv.querySelector('.remove-answer').addEventListener('click', function() {
                    newAnswerDiv.remove();
                });
            });

            document.querySelectorAll('.remove-answer').forEach(button => {
                button.addEventListener('click', function() {
                    button.closest('.flex.items-center.mt-2').remove();
                });
            });
        });
    </script>
    @endpush
</x-app-layout>