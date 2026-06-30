<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="gradient-text" style="font-size:1.6rem;font-weight:800;margin:0;">Manage Quiz</h2>
                <p style="color:#64748b;font-size:0.85rem;margin-top:2px;">Edit quiz details and configure questions in one place</p>
            </div>
            <a href="{{ route('admin.quiz.list') }}" class="btn-secondary" style="text-decoration:none;">
                ← Back to Quizzes
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-7xl mx-auto" style="padding:0 24px;">

            @if(session('success'))
                <div class="alert-success" style="margin-bottom:24px;display:flex;align-items:center;gap:10px;animation: fadeIn 0.4s ease-out;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <span style="font-weight:600;">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Responsive Two Column Grid Layout --}}
            <div style="display:grid;grid-template-columns:1fr;gap:32px;align-items:start;" class="lg-grid-cols">
                
                {{-- LEFT COLUMN: EDIT QUIZ DETAILS --}}
                <div class="glass-card" style="padding:32px;position:sticky;top:20px;">
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:24px;border-bottom:1px solid rgba(15,23,42,0.06);padding-bottom:16px;">
                        <div style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:14px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(245,158,11,0.2);">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </div>
                        <div>
                            <h3 style="color:#0f172a;font-weight:700;font-size:1.1rem;margin:0;">Quiz Settings</h3>
                            <p style="color:#64748b;font-size:0.75rem;margin-top:2px;">Update basic quiz metadata</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST">
                        @csrf
                        <div style="display:flex;flex-direction:column;gap:20px;">
                            <div>
                                <label class="dark-label">Quiz Title *</label>
                                <input type="text" name="title" value="{{ old('title', $quiz->title) }}" class="dark-input" required placeholder="e.g. Laravel Advanced">
                                @error('title')
                                    <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="dark-label">Description</label>
                                <textarea name="description" rows="2" class="dark-input" style="resize:vertical;" placeholder="Write brief instructions or description...">{{ old('description', $quiz->description) }}</textarea>
                                @error('description')
                                    <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="dark-label">Time Limit (Minutes) *</label>
                                <div style="position:relative;">
                                    <input type="number" name="time_limit" value="{{ old('time_limit', $quiz->time_limit) }}" min="1" class="dark-input" required style="padding-right:48px;">
                                    <span style="position:absolute;right:16px;top:50%;transform:translateY(-50%);color:#475569;font-size:0.85rem;font-weight:600;">MINS</span>
                                </div>
                                @error('time_limit')
                                    <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-top:28px;display:flex;gap:12px;">
                            <button type="submit" class="btn-primary" style="flex:1;background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 4px 15px rgba(245,158,11,0.2);">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>

                {{-- RIGHT COLUMN: QUESTIONS & ADD QUESTION FORM --}}
                <div style="display:flex;flex-direction:column;gap:32px;">
                    
                    {{-- Sub-Section: Add Question Form --}}
                    <div class="glass-card" style="padding:28px;">
                        <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;border-bottom:1px solid rgba(15,23,42,0.06);padding-bottom:14px;">
                            <div style="width:40px;height:40px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(99,102,241,0.2);">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            </div>
                            <div>
                                <h3 style="color:#0f172a;font-weight:700;font-size:1rem;margin:0;">Add New Question</h3>
                                <p style="color:#64748b;font-size:0.75rem;margin-top:2px;">Set up a question with options and correct answer</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('admin.questions.store') }}">
                            @csrf
                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                            <div style="display:flex;flex-direction:column;gap:16px;">
                                <div>
                                    <label class="dark-label">Question Text *</label>
                                    <input type="text" name="question" value="{{ old('question') }}" class="dark-input" required placeholder="Type the question statement...">
                                    @error('question')
                                        <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div style="display:grid;grid-template-columns:1fr;gap:14px;" class="sm-grid-cols-2">
                                    <div>
                                        <label class="dark-label">Option A *</label>
                                        <input type="text" name="option_a" value="{{ old('option_a') }}" class="dark-input" required placeholder="Option A">
                                        @error('option_a')
                                            <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="dark-label">Option B *</label>
                                        <input type="text" name="option_b" value="{{ old('option_b') }}" class="dark-input" required placeholder="Option B">
                                        @error('option_b')
                                            <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="dark-label">Option C *</label>
                                        <input type="text" name="option_c" value="{{ old('option_c') }}" class="dark-input" required placeholder="Option C">
                                        @error('option_c')
                                            <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="dark-label">Option D *</label>
                                        <input type="text" name="option_d" value="{{ old('option_d') }}" class="dark-input" required placeholder="Option D">
                                        @error('option_d')
                                            <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="dark-label">Correct Option *</label>
                                    <select name="correct_answer" class="dark-input" required style="cursor:pointer;background-color:#ffffff;">
                                        <option value="A" {{ old('correct_answer') == 'A' ? 'selected' : '' }}>Option A</option>
                                        <option value="B" {{ old('correct_answer') == 'B' ? 'selected' : '' }}>Option B</option>
                                        <option value="C" {{ old('correct_answer') == 'C' ? 'selected' : '' }}>Option C</option>
                                        <option value="D" {{ old('correct_answer') == 'D' ? 'selected' : '' }}>Option D</option>
                                    </select>
                                    @error('correct_answer')
                                        <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div style="margin-top:20px;display:flex;justify-content:flex-end;">
                                <button type="submit" class="btn-primary" style="display:inline-flex;align-items:center;gap:6px;padding:10px 24px;">
                                    <span>➕ Add Question</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Sub-Section: Question Listing --}}
                    <div>
                        <div style="display:flex;justify-content:between;align-items:center;margin-bottom:16px;">
                            <h4 style="color:#0f172a;font-weight:700;font-size:0.95rem;margin:0;text-transform:uppercase;letter-spacing:0.05em;">
                                Questions List ({{ $quiz->questions->count() }})
                            </h4>
                        </div>

                        @if($quiz->questions->isEmpty())
                            <div class="glass-card" style="padding:48px;text-align:center;color:#64748b;">
                                <div style="font-size:2.5rem;margin-bottom:12px;opacity:0.6;">📝</div>
                                <p style="font-size:0.9rem;color:#64748b;margin:0;">No questions added yet. Use the form above to add your first question!</p>
                            </div>
                        @else
                            <div style="display:flex;flex-direction:column;gap:16px;">
                                @foreach($quiz->questions as $index => $q)
                                    <div class="glass-card" style="overflow:hidden;transition:transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                                        {{-- Card Header --}}
                                        <div style="background:rgba(15,23,42,0.01);border-bottom:1px solid rgba(15,23,42,0.04);padding:14px 20px;display:flex;justify-content:space-between;align-items:center;">
                                            <span style="font-size:0.8rem;font-weight:800;color:#6366f1;text-transform:uppercase;letter-spacing:0.05em;">Question #{{ $index + 1 }}</span>
                                            <div style="display:flex;gap:8px;">
                                                <a href="{{ route('admin.questions.edit', $q->id) }}" class="btn-secondary" style="padding:4px 10px;font-size:0.7rem;border-radius:6px;">
                                                    ✏️ Edit
                                                </a>
                                                <a href="{{ route('admin.questions.delete', $q->id) }}" onclick="return confirm('Are you sure you want to delete this question?')" class="btn-danger" style="padding:4px 10px;font-size:0.7rem;border-radius:6px;text-decoration:none;">
                                                    🗑 Delete
                                                </a>
                                            </div>
                                        </div>

                                        {{-- Card Body --}}
                                        <div style="padding:20px;">
                                            <p style="color:#0f172a;font-weight:600;font-size:0.95rem;margin-top:0;margin-bottom:16px;line-height:1.5;">{{ $q->question }}</p>
                                            
                                            <div style="display:grid;grid-template-columns:1fr;gap:10px;" class="sm-grid-cols-2">
                                                @foreach(['A' => $q->option_a, 'B' => $q->option_b, 'C' => $q->option_c, 'D' => $q->option_d] as $key => $val)
                                                    @php
                                                        $isCorrect = strtoupper($q->correct_answer) === $key;
                                                    @endphp
                                                    <div style="display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:8px;border:1px solid {{ $isCorrect ? 'rgba(34,197,94,0.3)' : 'rgba(15,23,42,0.06)' }};background:{{ $isCorrect ? 'rgba(34,197,94,0.05)' : 'rgba(15,23,42,0.01)' }}">
                                                        <span style="width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:800;background:{{ $isCorrect ? '#22c55e' : 'rgba(15,23,42,0.08)' }};color:{{ $isCorrect ? 'white' : '#475569' }}">
                                                            {{ $key }}
                                                        </span>
                                                        <span style="font-size:0.85rem;color:{{ $isCorrect ? '#16a34a' : '#334155' }};font-weight:{{ $isCorrect ? '600' : 'normal' }}">
                                                            {{ $val }}
                                                        </span>
                                                        @if($isCorrect)
                                                            <span style="margin-left:auto;color:#16a34a;font-size:0.7rem;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;display:inline-flex;align-items:center;gap:2px;">
                                                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> Correct
                                                            </span>
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
            </div>
        </div>
    </div>

    {{-- Layout helper styles --}}
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media(min-width: 1024px) {
            .lg-grid-cols {
                grid-template-columns: 420px 1fr !important;
            }
        }
        @media(min-width: 640px) {
            .sm-grid-cols-2 {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
    </style>
</x-app-layout>