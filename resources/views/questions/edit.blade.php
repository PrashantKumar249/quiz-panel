<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="gradient-text" style="font-size:1.4rem;font-weight:800;margin:0;">Edit Question</h2>
                <p style="color:#64748b;font-size:0.8rem;margin-top:2px;">Update options and correct answer for this question</p>
            </div>
            <a href="{{ route('admin.quiz.edit', $question->quiz_id) }}" class="btn-secondary" style="text-decoration:none;">
                ← Back to Quiz
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-2xl mx-auto" style="padding:0 24px;">
            <div class="glass-card" style="padding:32px;">

                <div style="text-align:center;margin-bottom:28px;">
                    <div style="width:64px;height:64px;background:linear-gradient(135deg,#fbbf24,#d97706);border-radius:18px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;box-shadow:0 4px 12px rgba(251,191,36,0.2);">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <h3 style="color:#0f172a;font-weight:700;font-size:1.1rem;margin:0;">Update Question Statement</h3>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:4px;">Edit values for Options A, B, C, D and the correct target option</p>
                </div>

                <form method="POST" action="{{ route('admin.questions.update', $question->id) }}">
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ $question->quiz_id }}">

                    <div style="display:flex;flex-direction:column;gap:20px;">
                        <div>
                            <label class="dark-label">Question Text *</label>
                            <input type="text" name="question" value="{{ old('question', $question->question) }}" class="dark-input" required placeholder="Question statement...">
                            @error('question')
                                <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div style="display:grid;grid-template-columns:1fr;gap:16px;" class="sm-grid-cols-2">
                            <div>
                                <label class="dark-label">Option A *</label>
                                <input type="text" name="option_a" value="{{ old('option_a', $question->option_a) }}" class="dark-input" required placeholder="Option A">
                                @error('option_a')
                                    <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="dark-label">Option B *</label>
                                <input type="text" name="option_b" value="{{ old('option_b', $question->option_b) }}" class="dark-input" required placeholder="Option B">
                                @error('option_b')
                                    <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="dark-label">Option C *</label>
                                <input type="text" name="option_c" value="{{ old('option_c', $question->option_c) }}" class="dark-input" required placeholder="Option C">
                                @error('option_c')
                                    <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="dark-label">Option D *</label>
                                <input type="text" name="option_d" value="{{ old('option_d', $question->option_d) }}" class="dark-input" required placeholder="Option D">
                                @error('option_d')
                                    <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="dark-label">Correct Option *</label>
                            <select name="correct_answer" class="dark-input" required style="cursor:pointer;background-color:#ffffff;">
                                <option value="A" {{ old('correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>Option A</option>
                                <option value="B" {{ old('correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>Option B</option>
                                <option value="C" {{ old('correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>Option C</option>
                                <option value="D" {{ old('correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>Option D</option>
                            </select>
                            @error('correct_answer')
                                <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div style="display:flex;gap:12px;margin-top:28px;">
                        <button type="submit" class="btn-primary" style="flex:1;justify-content:center;padding:12px 24px;">
                            💾 Save Question
                        </button>
                        <a href="{{ route('admin.quiz.edit', $question->quiz_id) }}" class="btn-secondary" style="text-decoration:none;padding:12px 24px;justify-content:center;">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <style>
        @media(min-width: 640px) {
            .sm-grid-cols-2 {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
    </style>
</x-app-layout>