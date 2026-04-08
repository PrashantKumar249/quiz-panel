<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📝 {{ $attempt->quiz->title }}
            </h2>
            {{-- Timer --}}
            <div class="flex items-center gap-2 bg-red-100 border border-red-300 px-4 py-2 rounded-lg">
                <span class="text-red-600 font-bold text-lg">⏱️</span>
                <span id="timer" class="text-red-700 font-bold text-xl font-mono">
                    {{ str_pad($attempt->quiz->time_limit, 2, '0', STR_PAD_LEFT) }}:00
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Quiz Form --}}
            <form id="quizForm" action="{{ route('user.quiz.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">

                {{-- Questions --}}
                @foreach($attempt->quiz->questions as $index => $question)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-5 overflow-hidden">

                        {{-- Question Header --}}
                        <div class="bg-gray-50 border-b border-gray-200 px-6 py-3">
                            <span class="text-sm font-semibold text-gray-500">
                                Question {{ $index + 1 }} of {{ $attempt->quiz->questions->count() }}
                            </span>
                        </div>

                        {{-- Question Text --}}
                        <div class="px-6 pt-4 pb-2">
                            <p class="text-gray-800 font-medium text-base leading-relaxed">
                                {{ $question->question }}
                            </p>
                        </div>

                        {{-- Options --}}
                        <div class="px-6 pb-5 space-y-3 mt-3">
                            @foreach(['A' => $question->option_a, 'B' => $question->option_b, 'C' => $question->option_c, 'D' => $question->option_d] as $key => $value)
                                <label class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-indigo-50 hover:border-indigo-300 cursor-pointer transition-all duration-150 option-label">
                                    <input
                                        type="radio"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $key }}"
                                        class="text-indigo-600 focus:ring-indigo-500 w-4 h-4"
                                    >
                                    <span class="flex items-center gap-2 text-gray-700">
                                        <span class="w-7 h-7 flex items-center justify-center bg-indigo-100 text-indigo-700 font-bold rounded-full text-sm flex-shrink-0">
                                            {{ $key }}
                                        </span>
                                        {{ $value }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                {{-- Submit Button --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
                    <p class="text-gray-500 text-sm mb-4">
                        ⚠️ Submit karne ke baad answers change nahi ho sakte.
                    </p>
                    <button type="submit" id="submitBtn"
                        onclick="return confirm('Quiz submit karna chahte ho? Baad mein change nahi hoga!')"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-10 rounded-lg text-lg transition duration-200">
                        ✅ Submit Quiz
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Timer Script --}}
    <script>
        // Time limit minutes se seconds mein
        const totalSeconds = {{ $attempt->quiz->time_limit }} * 60;
        let remaining = totalSeconds;
        const timerEl = document.getElementById('timer');
        const form = document.getElementById('quizForm');

        function updateTimer() {
            const mins = Math.floor(remaining / 60);
            const secs = remaining % 60;
            timerEl.textContent = String(mins).padStart(2, '0') + ':' + String(secs).padStart(2, '0');

            // Last 60 seconds mein red warning
            if (remaining <= 60) {
                timerEl.parentElement.classList.add('animate-pulse');
            }

            if (remaining <= 0) {
                // Time khatam — auto submit
                clearInterval(countdown);
                alert('⏰ Time khatam! Quiz auto-submit ho raha hai.');
                form.submit();
                return;
            }

            remaining--;
        }

        updateTimer(); // Pehli baar turant chalao
        const countdown = setInterval(updateTimer, 1000);

        // Option select hone par highlight karo
        document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                // Same question ke saare labels reset karo
                const name = this.name;
                document.querySelectorAll(`input[name="${name}"]`).forEach(function(r) {
                    r.closest('label').classList.remove('bg-indigo-100', 'border-indigo-500');
                });
                // Selected ko highlight karo
                this.closest('label').classList.add('bg-indigo-100', 'border-indigo-500');
            });
        });

        // Page band karne se rokna (accidental close)
        window.addEventListener('beforeunload', function(e) {
            e.preventDefault();
            e.returnValue = '';
        });

        // Form submit hone ke baad warning hataao
        form.addEventListener('submit', function() {
            window.removeEventListener('beforeunload', function() {});
        });
    </script>
</x-app-layout>