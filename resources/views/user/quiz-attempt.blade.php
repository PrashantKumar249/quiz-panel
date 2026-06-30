<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="gradient-text" style="font-size:1.5rem;font-weight:800;margin:0;">📝 {{ $attempt->quiz->title }}</h2>
                <p style="color:#64748b;font-size:0.8rem;margin-top:2px;">Online Examination Portal</p>
            </div>
            {{-- Modern Glowing Timer --}}
            <div style="display:flex;align-items:center;gap:12px;background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.15);padding:10px 20px;border-radius:12px;box-shadow:0 4px 15px rgba(239,68,68,0.05);" id="timer-box">
                <span style="font-size:1.2rem;animation: pulse 1.5s infinite;">⏱️</span>
                <span id="timer" style="color:#dc2626;font-weight:800;font-size:1.3rem;font-family:monospace;letter-spacing:1px;">
                    {{ str_pad($attempt->quiz->time_limit, 2, '0', STR_PAD_LEFT) }}:00
                </span>
            </div>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-7xl mx-auto" style="padding:0 24px;">

            {{-- Exam Layout Columns --}}
            <div style="display:grid;grid-template-columns:1fr;gap:28px;align-items:start;" class="exam-grid">

                {{-- Left Content Area: Question Display --}}
                <div style="display:flex;flex-direction:column;gap:24px;">
                    <form id="quizForm" action="{{ route('user.quiz.submit') }}" method="POST" style="margin:0;">
                        @csrf
                        <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">

                        @foreach($attempt->quiz->questions as $index => $question)
                            <div class="glass-card question-pane" id="q-pane-{{ $index }}" style="display:{{ $index === 0 ? 'block' : 'none' }};">
                                {{-- Question Sub-Header --}}
                                <div style="display:flex;justify-content:space-between;align-items:center;background:rgba(15,23,42,0.02);border-bottom:1px solid rgba(15,23,42,0.05);padding:14px 24px;border-top-left-radius:16px;border-top-right-radius:16px;">
                                    <span style="font-size:0.8rem;font-weight:700;color:#6366f1;text-transform:uppercase;letter-spacing:0.05em;">
                                        Question {{ $index + 1 }} of {{ $attempt->quiz->questions->count() }}
                                    </span>
                                    <span style="font-size:0.75rem;background:rgba(99,102,241,0.08);color:#4f46e5;padding:4px 10px;border-radius:6px;font-weight:600;">
                                        1.0 Mark
                                    </span>
                                </div>

                                {{-- Question Content --}}
                                <div style="padding:28px;">
                                    <p style="color:#0f172a;font-weight:700;font-size:1.1rem;line-height:1.6;margin-top:0;margin-bottom:24px;">
                                        {{ $question->question }}
                                    </p>

                                    {{-- Options Selection --}}
                                    <div style="display:flex;flex-direction:column;gap:14px;">
                                        @foreach(['A' => $question->option_a, 'B' => $question->option_b, 'C' => $question->option_c, 'D' => $question->option_d] as $key => $value)
                                            <label class="option-label" id="label-{{ $question->id }}-{{ $key }}" style="display:flex;align-items:center;gap:12px;padding:16px 20px;border-radius:10px;border:1px solid rgba(15,23,42,0.08);background:rgba(255,255,255,0.4);cursor:pointer;transition:all 0.15s;">
                                                <input
                                                    type="radio"
                                                    name="answers[{{ $question->id }}]"
                                                    value="{{ $key }}"
                                                    onchange="onOptionSelect({{ $index }}, '{{ $question->id }}', '{{ $key }}')"
                                                    style="text-shadow:none;border-color:#cbd5e1;color:#4f46e5;width:18px;height:18px;"
                                                >
                                                <span style="display:flex;align-items:center;gap:12px;color:#334155;font-weight:500;font-size:0.95rem;">
                                                    <span style="width:24px;height:24px;border-radius:50%;background:rgba(99,102,241,0.08);color:#4f46e5;font-weight:800;font-size:0.75rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                        {{ $key }}
                                                    </span>
                                                    {{ $value }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </form>

                    {{-- Actions Navigation Bar --}}
                    <div class="glass-card" style="padding:16px 24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
                        <div style="display:flex;gap:10px;">
                            <button id="prevBtn" onclick="navigateQuestion(-1)" class="btn-secondary" style="padding:10px 18px;font-size:0.85rem;font-weight:700;">
                                ← Previous
                            </button>
                            <button onclick="clearResponse()" class="btn-secondary" style="padding:10px 18px;font-size:0.85rem;font-weight:700;color:#ef4444;border-color:rgba(239,68,68,0.2);background:rgba(239,68,68,0.02);">
                                🗑️ Clear Response
                            </button>
                        </div>
                        <div style="display:flex;gap:10px;">
                            <button id="reviewBtn" onclick="toggleMarkReview()" class="btn-secondary" style="padding:10px 18px;font-size:0.85rem;font-weight:700;color:#d97706;border-color:rgba(217,119,6,0.2);background:rgba(217,119,6,0.02);">
                                ⭐ Mark for Review
                            </button>
                            <button id="nextBtn" onclick="navigateQuestion(1)" class="btn-primary" style="padding:10px 24px;font-size:0.85rem;font-weight:700;">
                                Next →
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Right Column Sidebar: Question Palette & Legends --}}
                <div style="display:flex;flex-direction:column;gap:24px;">
                    
                    {{-- Palette Box --}}
                    <div class="glass-card" style="padding:24px;">
                        <h3 style="color:#0f172a;font-weight:700;font-size:0.95rem;margin:0 0 16px 0;text-transform:uppercase;letter-spacing:0.05em;border-bottom:1px solid rgba(15,23,42,0.05);padding-bottom:12px;">
                            Question Palette
                        </h3>

                        {{-- Badges Palette Grid --}}
                        <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:10px;margin-bottom:24px;" id="palette-grid">
                            @foreach($attempt->quiz->questions as $index => $question)
                                <button id="palette-badge-{{ $index }}" onclick="jumpToQuestion({{ $index }})" 
                                    class="palette-btn badge-unvisited">
                                    {{ $index + 1 }}
                                </button>
                            @endforeach
                        </div>

                        {{-- Legend List --}}
                        <div style="display:flex;flex-direction:column;gap:10px;border-top:1px solid rgba(15,23,42,0.05);padding-top:16px;font-size:0.8rem;color:#475569;font-weight:500;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <span class="legend-indicator badge-answered"></span>
                                <span>Answered</span>
                            </div>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <span class="legend-indicator badge-marked"></span>
                                <span>Marked for Review</span>
                            </div>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <span class="legend-indicator badge-visited"></span>
                                <span>Visited (Unanswered)</span>
                            </div>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <span class="legend-indicator badge-unvisited"></span>
                                <span>Not Visited</span>
                            </div>
                        </div>
                    </div>

                    {{-- Summary Block --}}
                    <div class="glass-card" style="padding:24px;border:1px solid rgba(16,185,129,0.2);background:rgba(16,185,129,0.01);">
                        <h4 style="color:#0f172a;font-size:0.9rem;font-weight:700;margin:0 0 14px 0;text-transform:uppercase;letter-spacing:0.04em;">Attempt Status</h4>
                        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px;text-align:center;">
                            <div style="background:rgba(15,23,42,0.02);padding:10px;border-radius:8px;">
                                <p style="font-size:1.3rem;font-weight:800;color:#16a34a;margin:0;line-height:1;" id="summary-answered">0</p>
                                <p style="font-size:0.65rem;color:#64748b;font-weight:600;margin:4px 0 0 0;text-transform:uppercase;">Answered</p>
                            </div>
                            <div style="background:rgba(15,23,42,0.02);padding:10px;border-radius:8px;">
                                <p style="font-size:1.3rem;font-weight:800;color:#d97706;margin:0;line-height:1;" id="summary-marked">0</p>
                                <p style="font-size:0.65rem;color:#64748b;font-weight:600;margin:4px 0 0 0;text-transform:uppercase;">Marked</p>
                            </div>
                            <div style="background:rgba(15,23,42,0.02);padding:10px;border-radius:8px;">
                                <p style="font-size:1.3rem;font-weight:800;color:#dc2626;margin:0;line-height:1;" id="summary-visited">0</p>
                                <p style="font-size:0.65rem;color:#64748b;font-weight:600;margin:4px 0 0 0;text-transform:uppercase;">Visited</p>
                            </div>
                            <div style="background:rgba(15,23,42,0.02);padding:10px;border-radius:8px;">
                                <p style="font-size:1.3rem;font-weight:800;color:#64748b;margin:0;line-height:1;" id="summary-unvisited">0</p>
                                <p style="font-size:0.65rem;color:#64748b;font-weight:600;margin:4px 0 0 0;text-transform:uppercase;">Unvisited</p>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Trigger Box --}}
                    <div class="glass-card" style="padding:24px;text-align:center;">
                        <button onclick="submitExam()" class="btn-primary" style="width:100%;justify-content:center;padding:12px;background:linear-gradient(135deg,#10b981,#059669);font-weight:700;font-size:0.95rem;">
                            🏁 Final Submit Test
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </div>

    {{-- Script Operations --}}
    <script>
        const totalQuestions = {{ $attempt->quiz->questions->count() }};
        let currentIdx = 0;

        // Question States Array: 0=Unvisited, 1=Visited, 2=Answered, 3=Marked
        const qStates = new Array(totalQuestions).fill(0);
        qStates[0] = 1; // Visited first question

        // Map correct question IDs and answers
        const activeAnswers = {};

        function onOptionSelect(idx, qId, key) {
            // Update selection label highlighting
            document.querySelectorAll(`label[id^="label-${qId}-"]`).forEach(el => {
                el.style.borderColor = 'rgba(15,23,42,0.08)';
                el.style.background = 'rgba(255,255,255,0.4)';
            });
            const selectedLabel = document.getElementById(`label-${qId}-${key}`);
            if (selectedLabel) {
                selectedLabel.style.borderColor = '#6366f1';
                selectedLabel.style.background = 'rgba(99,102,241,0.04)';
            }

            activeAnswers[qId] = key;
            if (qStates[idx] !== 3) { // Do not overwrite if Marked
                qStates[idx] = 2; // Answered
            }
            updatePaletteUI();
        }

        function clearResponse() {
            const pane = document.getElementById(`q-pane-${currentIdx}`);
            const radios = pane.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => {
                radio.checked = false;
            });

            // Reset labels border
            pane.querySelectorAll('.option-label').forEach(el => {
                el.style.borderColor = 'rgba(15,23,42,0.08)';
                el.style.background = 'rgba(255,255,255,0.4)';
            });

            qStates[currentIdx] = 1; // Visited (Unanswered)
            updatePaletteUI();
        }

        function toggleMarkReview() {
            if (qStates[currentIdx] === 3) {
                // Remove mark
                const pane = document.getElementById(`q-pane-${currentIdx}`);
                const hasSelected = pane.querySelector('input[type="radio"]:checked');
                qStates[currentIdx] = hasSelected ? 2 : 1;
            } else {
                qStates[currentIdx] = 3; // Marked for Review
            }
            updatePaletteUI();
        }

        function navigateQuestion(step) {
            let targetIdx = currentIdx + step;
            if (targetIdx >= 0 && targetIdx < totalQuestions) {
                jumpToQuestion(targetIdx);
            }
        }

        function jumpToQuestion(targetIdx) {
            // Hide current pane
            document.getElementById(`q-pane-${currentIdx}`).style.display = 'none';

            // Mark old question as Visited if it was Unvisited
            if (qStates[currentIdx] === 0) {
                qStates[currentIdx] = 1;
            }

            currentIdx = targetIdx;

            // Show target pane
            document.getElementById(`q-pane-${currentIdx}`).style.display = 'block';

            // Mark target question as Visited if Unvisited
            if (qStates[currentIdx] === 0) {
                qStates[currentIdx] = 1;
            }

            updatePaletteUI();
        }

        function updatePaletteUI() {
            let answered = 0, marked = 0, visited = 0, unvisited = 0;

            for (let i = 0; i < totalQuestions; i++) {
                const badge = document.getElementById(`palette-badge-${i}`);
                if (!badge) continue;

                // Reset badge classes
                badge.className = 'palette-btn';

                if (i === currentIdx) {
                    badge.classList.add('active-border');
                }

                const state = qStates[i];
                if (state === 2) {
                    badge.classList.add('badge-answered');
                    answered++;
                } else if (state === 3) {
                    badge.classList.add('badge-marked');
                    marked++;
                } else if (state === 1) {
                    badge.classList.add('badge-visited');
                    visited++;
                } else {
                    badge.classList.add('badge-unvisited');
                    unvisited++;
                }
            }

            // Update navigation control states
            document.getElementById('prevBtn').disabled = currentIdx === 0;
            document.getElementById('nextBtn').disabled = currentIdx === totalQuestions - 1;

            // Update stats elements
            document.getElementById('summary-answered').textContent = answered;
            document.getElementById('summary-marked').textContent = marked;
            document.getElementById('summary-visited').textContent = visited;
            document.getElementById('summary-unvisited').textContent = unvisited;
        }

        function submitExam() {
            if (confirm("Are you sure you want to submit your quiz? You will not be able to change your answers later!")) {
                window.removeEventListener('beforeunload', beforeUnloadWarning);
                document.getElementById('quizForm').submit();
            }
        }

        // Initialize UI
        updatePaletteUI();

        // Timer Mechanics
        const totalSeconds = {{ $attempt->quiz->time_limit }} * 60;
        let remaining = totalSeconds;
        const timerEl = document.getElementById('timer');
        const timerBox = document.getElementById('timer-box');
        const formEl = document.getElementById('quizForm');

        function beforeUnloadWarning(e) {
            e.preventDefault();
            e.returnValue = '';
        }

        window.addEventListener('beforeunload', beforeUnloadWarning);

        const countdown = setInterval(() => {
            if (remaining <= 0) {
                clearInterval(countdown);
                window.removeEventListener('beforeunload', beforeUnloadWarning);
                alert("⏰ Time is up! Your quiz will now be submitted automatically.");
                formEl.submit();
                return;
            }

            remaining--;
            const mins = Math.floor(remaining / 60);
            const secs = remaining % 60;
            timerEl.textContent = String(mins).padStart(2, '0') + ':' + String(secs).padStart(2, '0');

            // Alarm styles for final 60 seconds
            if (remaining <= 60) {
                timerEl.style.color = '#dc2626';
                timerBox.style.background = 'rgba(239,68,68,0.15)';
                timerBox.style.borderColor = 'rgba(239,68,68,0.3)';
                timerBox.classList.add('animate-pulse');
            } else {
                timerEl.style.color = '#000000';
                timerBox.style.background = 'rgba(15,23,42,0.03)';
                timerBox.style.borderColor = 'rgba(15,23,42,0.08)';
            }
        }, 1000);
    </script>

    <style>
        .palette-btn {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .palette-btn:hover {
            transform: scale(1.08);
        }
        .palette-btn:focus {
            outline: none;
        }
        .active-border {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 10px rgba(79,70,229,0.35);
        }

        /* Status Colors */
        .badge-answered {
            background-color: #22c55e !important;
            color: #ffffff !important;
        }
        .badge-marked {
            background-color: #f59e0b !important;
            color: #ffffff !important;
        }
        .badge-visited {
            background-color: #ef4444 !important;
            color: #ffffff !important;
        }
        .badge-unvisited {
            background-color: rgba(15,23,42,0.06) !important;
            color: #475569 !important;
            border: 1px solid rgba(15,23,42,0.08) !important;
        }

        .legend-indicator {
            width: 14px;
            height: 14px;
            border-radius: 4px;
            display: inline-block;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.15); }
        }

        @media(min-width: 1024px) {
            .exam-grid {
                grid-template-columns: 1fr 300px !important;
            }
        }
    </style>
</x-app-layout>