<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🏆 Quiz Result — {{ $attempt->quiz->title }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Score Card --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-6">

                {{-- Top Banner --}}
                @if($attempt->score >= 70)
                    <div class="bg-gradient-to-r from-green-400 to-emerald-500 p-6 text-center">
                        <p class="text-white text-5xl mb-2">🎉</p>
                        <h3 class="text-white font-bold text-2xl">Congratulations!</h3>
                        <p class="text-green-100 mt-1">Bahut achha kiya!</p>
                    </div>
                @elseif($attempt->score >= 40)
                    <div class="bg-gradient-to-r from-yellow-400 to-orange-400 p-6 text-center">
                        <p class="text-white text-5xl mb-2">👍</p>
                        <h3 class="text-white font-bold text-2xl">Theek tha!</h3>
                        <p class="text-yellow-100 mt-1">Aur practice karo!</p>
                    </div>
                @else
                    <div class="bg-gradient-to-r from-red-400 to-rose-500 p-6 text-center">
                        <p class="text-white text-5xl mb-2">💪</p>
                        <h3 class="text-white font-bold text-2xl">Keep Trying!</h3>
                        <p class="text-red-100 mt-1">Practice se sab hota hai!</p>
                    </div>
                @endif

                {{-- Stats Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-y md:divide-y-0 border-t border-gray-100">
                    <div class="p-5 text-center">
                        <p class="text-3xl font-bold text-gray-800">{{ $attempt->score }}%</p>
                        <p class="text-gray-500 text-sm mt-1">Score</p>
                    </div>
                    <div class="p-5 text-center">
                        <p class="text-3xl font-bold text-gray-600">{{ $attempt->total_questions }}</p>
                        <p class="text-gray-500 text-sm mt-1">Total Questions</p>
                    </div>
                    <div class="p-5 text-center">
                        <p class="text-3xl font-bold text-green-600">{{ $attempt->correct_answers }}</p>
                        <p class="text-gray-500 text-sm mt-1">✅ Correct</p>
                    </div>
                    <div class="p-5 text-center">
                        <p class="text-3xl font-bold text-red-500">{{ $attempt->wrong_answers }}</p>
                        <p class="text-gray-500 text-sm mt-1">❌ Wrong</p>
                    </div>
                </div>
            </div>

            {{-- Answer Review --}}
            <h3 class="text-lg font-semibold text-gray-700 mb-3">📋 Answer Review</h3>

            @foreach($attempt->answers as $index => $answer)
                <div class="bg-white rounded-xl shadow-sm border mb-4 overflow-hidden
                    {{ $answer->is_correct ? 'border-green-200' : 'border-red-200' }}">

                    <div class="px-5 py-3 flex justify-between items-center
                        {{ $answer->is_correct ? 'bg-green-50' : 'bg-red-50' }}">
                        <span class="text-sm font-semibold text-gray-600">Q{{ $index + 1 }}</span>
                        <span class="text-sm font-bold {{ $answer->is_correct ? 'text-green-600' : 'text-red-600' }}">
                            {{ $answer->is_correct ? '✅ Correct' : '❌ Wrong' }}
                        </span>
                    </div>

                    <div class="px-5 py-4">
                        <p class="text-gray-800 font-medium mb-3">{{ $answer->question->question }}</p>

                        <div class="grid grid-cols-2 gap-2 text-sm">
                            @foreach(['A' => $answer->question->option_a, 'B' => $answer->question->option_b, 'C' => $answer->question->option_c, 'D' => $answer->question->option_d] as $key => $val)
                                <div class="flex items-center gap-2 p-2 rounded-lg
                                    {{ strtoupper($key) === strtoupper($answer->question->correct_answer) ? 'bg-green-100 border border-green-300' : '' }}
                                    {{ $answer->selected_option && strtoupper($answer->selected_option) === strtoupper($key) && !$answer->is_correct ? 'bg-red-100 border border-red-300' : '' }}">
                                    <span class="font-bold w-6 text-center">{{ $key }}</span>
                                    <span>{{ $val }}</span>
                                    @if(strtoupper($key) === strtoupper($answer->question->correct_answer))
                                        <span class="ml-auto text-green-600 font-bold">✓</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @if(!$answer->selected_option)
                            <p class="text-orange-500 text-sm mt-2 font-medium">⚠️ Attempted nahi kiya (skipped)</p>
                        @endif
                    </div>
                </div>
            @endforeach

            {{-- Action Buttons --}}
            <div class="flex gap-3 mt-6">
                <a href="{{ route('dashboard') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    🏠 Dashboard
                </a>
                <a href="{{ route('user.history') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    📋 My History
                </a>
            </div>

        </div>
    </div>
</x-app-layout>