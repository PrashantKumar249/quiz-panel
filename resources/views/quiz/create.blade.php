<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="gradient-text" style="font-size:1.4rem;font-weight:800;margin:0;">Create New Quiz</h2>
                <p style="color:#64748b;font-size:0.8rem;margin-top:2px;">Fill in the details to create a new quiz</p>
            </div>
            <a href="{{ route('admin.quiz.list') }}" class="btn-secondary" style="text-decoration:none;">← Back to Quizzes</a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-2xl mx-auto" style="padding:0 24px;">

            @if(session('success'))
                <div class="alert-success" style="margin-bottom:20px;display:flex;align-items:center;gap:10px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="glass-card" style="padding:32px;">

                {{-- Icon Header --}}
                <div style="text-align:center;margin-bottom:28px;">
                    <div style="width:64px;height:64px;background:linear-gradient(135deg,#6366f1,#a855f7);border-radius:18px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    </div>
                    <h3 style="color:#e2e8f0;font-weight:700;font-size:1.1rem;margin:0;">New Quiz</h3>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:4px;">Create an engaging quiz for your students</p>
                </div>

                <form method="POST" action="{{ route('admin.quiz.store') }}">
                    @csrf

                    <div style="display:flex;flex-direction:column;gap:20px;">
                        <div>
                            <label class="dark-label">Quiz Title *</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="dark-input"
                                placeholder="e.g. PHP Fundamentals, Laravel Quiz">
                            @error('title')
                                <p style="color:#f87171;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="dark-label">Description <span style="color:#475569;font-weight:400;text-transform:none;">(Optional)</span></label>
                            <textarea name="description" rows="3" class="dark-input" style="resize:vertical;"
                                placeholder="Quiz ke baare mein kuch likho...">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="dark-label">Time Limit (Minutes) *</label>
                            <input type="number" name="time_limit" value="{{ old('time_limit') }}" min="1" class="dark-input"
                                placeholder="e.g. 30">
                            @error('time_limit')
                                <p style="color:#f87171;font-size:0.75rem;margin-top:6px;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div style="display:flex;gap:12px;margin-top:28px;">
                        <button type="submit" class="btn-primary" style="flex:1;justify-content:center;padding:12px 24px;font-size:0.95rem;">
                            🚀 Create Quiz
                        </button>
                        <a href="{{ route('admin.quiz.list') }}" class="btn-secondary" style="text-decoration:none;padding:12px 24px;">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>