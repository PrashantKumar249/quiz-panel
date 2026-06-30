<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="gradient-text" style="font-size:1.4rem;font-weight:800;margin:0;">Add Question</h2>
                <p style="color:#64748b;font-size:0.8rem;margin-top:2px;">Add a new question to this quiz</p>
            </div>
            <a href="{{ route('admin.quiz.edit', $quiz_id) }}" class="btn-secondary" style="text-decoration:none;">
                ← Back to Quiz
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-2xl mx-auto" style="padding:0 24px;">
            <div class="glass-card" style="padding:32px;">

                @if(session('success'))
                    <div class="alert-success" style="margin-bottom:20px;display:flex;align-items:center;gap:10px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <div style="text-align:center;margin-bottom:28px;">
                    <div style="width:64px;height:64px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:18px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;box-shadow:0 4px 12px rgba(99,102,241,0.2);">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </div>
                    <h3 style="color:#0f172a;font-weight:700;font-size:1.1rem;margin:0;">Create Question Statement</h3>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:4px;">Define options A, B, C, D and the correct target option</p>
                </div>

                <form method="POST" action="{{ route('admin.questions.store') }}">
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ $quiz_id }}">

                    <div style="display:flex;flex-direction:column;gap:20px;">
                        <div>
                            <label class="dark-label">Question Text *</label>
                            <input type="text" name="question" value="{{ old('question') }}" class="dark-input" required placeholder="Question statement...">
                            @error('question')
                                <p style="color:#dc2626;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div style="display:grid;grid-template-columns:1fr;gap:16px;" class="sm-grid-cols-2">
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

                    <div style="display:flex;gap:12px;margin-top:28px;">
                        <button type="submit" class="btn-primary" style="flex:1;justify-content:center;padding:12px 24px;">
                            ➕ Add Question
                        </button>
                        <a href="{{ route('admin.quiz.edit', $quiz_id) }}" class="btn-secondary" style="text-decoration:none;padding:12px 24px;justify-content:center;">
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