<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎯 Available Quizzes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome Message --}}
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-blue-800 text-lg font-medium">
                    👋 Welcome, <strong>{{ Auth::user()->name }}</strong>!
                    Select a quiz to start your test.
                </p>
            </div>

            {{-- Navigation Links --}}
            <div class="mb-4 flex gap-3">
                <a href="{{ route('user.history') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    📋 My Test History
                </a>
            </div>

            {{-- Quiz Cards --}}
            @if($quizzes->isEmpty())
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <p class="text-gray-500 text-lg">😕 Koi quiz available nahi hai abhi. Please baad mein check karein.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($quizzes as $quiz)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">

                            {{-- Card Header --}}
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4">
                                <h3 class="text-white font-bold text-lg">{{ $quiz->title }}</h3>
                            </div>

                            {{-- Card Body --}}
                            <div class="p-5">
                                @if($quiz->description)
                                    <p class="text-gray-600 text-sm mb-4">{{ $quiz->description }}</p>
                                @endif

                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span class="flex items-center gap-1">
                                        ❓ <strong>{{ $quiz->questions_count }}</strong> Questions
                                    </span>
                                    <span class="flex items-center gap-1">
                                        ⏱️ <strong>{{ $quiz->time_limit }}</strong> Minutes
                                    </span>
                                </div>

                                {{-- Start Button --}}
                                <form action="{{ route('user.quiz.start', $quiz->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        onclick="return confirm('Quiz start karna chahte ho? Timer shuru ho jayega!')"
                                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                                        🚀 Start Quiz
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>