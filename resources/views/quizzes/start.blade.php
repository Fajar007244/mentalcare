<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    <h3 class="text-xl font-bold text-gray-800">{{ $quiz->description }}</h3>
                </div>
                <form action="{{ route('quizzes.storeAttempt', $quiz) }}" method="POST">
                    @csrf
                    <div class="bg-gray-50 px-6 lg:px-8 py-8">
                        <div class="space-y-10">
                            @foreach ($quiz->questions as $question)
                                <fieldset>
                                    <legend class="text-lg font-semibold text-gray-900">{{ $loop->iteration }}. {{ $question->question_text }}</legend>
                                    <div class="mt-4 space-y-3">
                                        @foreach (json_decode($question->options, true) as $option)
                                            <label for="question-{{ $question->id }}-option-{{ $loop->index }}" 
                                                   class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 cursor-pointer transition-colors">
                                                <input id="question-{{ $question->id }}-option-{{ $loop->index }}" 
                                                       name="answers[{{ $question->id }}]" 
                                                       type="radio" 
                                                       value="{{ $option['score'] }}" 
                                                       class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" 
                                                       required>
                                                    <span class="ml-4 text-sm font-medium text-gray-700">{{ $option['text'] }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-6 lg:p-8 bg-white border-t border-gray-200 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Selesai & Lihat Hasil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>