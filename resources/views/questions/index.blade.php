<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ❓ Questions — <span class="text-indigo-600">{{ $quiz->title }}</span>
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.questions.create', $quiz->id) }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    ➕ Add Question
                </a>
                <a href="{{ route('admin.quiz.list') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    ← Back to Quizzes
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Quiz Info Bar --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-5 flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-2xl">📚</div>
                <div>
                    <p class="font-semibold text-gray-800">{{ $quiz->title }}</p>
                    <p class="text-gray-500 text-sm">
                        {{ $quiz->description ?? 'No description' }} &nbsp;•&nbsp;
                        <span class="text-yellow-600 font-medium">⏱ {{ $quiz->time_limit }} mins</span> &nbsp;•&nbsp;
                        <span class="text-indigo-600 font-medium">{{ $quiz->questions->count() }} questions</span>
                    </p>
                </div>
            </div>

            @if($quiz->questions->isEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="text-5xl mb-3">📝</div>
                    <p class="text-gray-500 mb-4">Is quiz mein abhi koi question nahi hai.</p>
                    <a href="{{ route('admin.questions.create', $quiz->id) }}"
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition">
                        ➕ Pehla Question Add Karo
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($quiz->questions as $index => $q)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-5 py-3 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-600">Q{{ $index + 1 }}</span>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.questions.edit', $q->id) }}"
                                       class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded text-xs font-medium transition">
                                        ✏️ Edit
                                    </a>
                                    <a href="{{ route('admin.questions.delete', $q->id) }}"
                                       onclick="return confirm('Is question ko delete karna chahte ho?')"
                                       class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-1 rounded text-xs font-medium transition">
                                        🗑 Delete
                                    </a>
                                </div>
                            </div>
                            <div class="px-5 py-4">
                                <p class="font-medium text-gray-800 mb-3">{{ $q->question }}</p>
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    @foreach(['A' => $q->option_a, 'B' => $q->option_b, 'C' => $q->option_c, 'D' => $q->option_d] as $key => $val)
                                        <div class="flex items-center gap-2 p-2 rounded-lg border
                                            {{ strtoupper($q->correct_answer) === $key ? 'bg-green-50 border-green-300' : 'border-gray-200' }}">
                                            <span class="font-bold w-6 h-6 flex items-center justify-center rounded-full text-xs
                                                {{ strtoupper($q->correct_answer) === $key ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }}">
                                                {{ $key }}
                                            </span>
                                            <span class="{{ strtoupper($q->correct_answer) === $key ? 'text-green-800 font-semibold' : 'text-gray-700' }}">
                                                {{ $val }}
                                            </span>
                                            @if(strtoupper($q->correct_answer) === $key)
                                                <span class="ml-auto text-green-600 text-xs font-bold">✓ Correct</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>