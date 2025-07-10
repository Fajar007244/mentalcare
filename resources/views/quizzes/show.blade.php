<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4">{{ $quiz->title }}</h3>
                    <p class="text-gray-600 mb-6">{{ $quiz->description }}</p>

                    <form action="{{ route('quizzes.submit', $quiz) }}" method="POST">
                        @csrf
                        @foreach ($quiz->questions as $question)
                            <div class="mb-6 p-4 border rounded-lg shadow-sm">
                                <p class="font-semibold text-lg mb-2">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                                @php
                                    $options = json_decode($question->options, true);
                                @endphp
                                @foreach ($options as $option)
                                    <label class="inline-flex items-center mt-2">
                                        <input type="radio" class="form-radio" name="question_{{ $question->id }}" value="{{ $option['text'] }}" required>
                                        <span class="ml-2 text-gray-700">{{ $option['text'] }}</span>
                                    </label><br>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Submit Quiz
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
