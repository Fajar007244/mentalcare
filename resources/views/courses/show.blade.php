<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold">{{ $course->title }}</h3>
                    <p class="mt-4 text-gray-600">{{ $course->description }}</p>

                    <div class="mt-6">
                        @if($course->content_type == 'video')
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe src="{{ $course->embed_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @elseif($course->content_type == 'pdf')
                            <a href="{{ $course->content_path }}" target="_blank" class="text-blue-600 hover:text-blue-900">Download PDF</a>
                        @elseif($course->content_type == 'podcast')
                             <audio controls src="{{ $course->content_path }}">
                                Your browser does not support the audio element.
                            </audio>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('courses.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Back to Courses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
