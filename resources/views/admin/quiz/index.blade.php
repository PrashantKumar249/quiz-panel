<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="gradient-text" style="font-size:1.4rem;font-weight:800;margin:0;">All Quizzes</h2>
                <p style="color:#64748b;font-size:0.8rem;margin-top:2px;">Manage all quizzes and their questions</p>
            </div>
            <div style="display:flex;gap:10px;align-items:center;">
                <a href="{{ route('admin.quiz.create') }}" class="btn-primary" style="text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Create Quiz
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn-secondary" style="text-decoration:none;">
                    ← Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-7xl mx-auto" style="padding:0 24px;">

            @if(session('success'))
                <div class="alert-success" style="margin-bottom:20px;display:flex;align-items:center;gap:10px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="glass-card" style="overflow-x:auto;width:100%;">
                <table class="dark-table" style="width:100%;border-collapse:collapse;min-width:650px;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">#</th>
                            <th style="text-align:left;">Quiz Title</th>
                            <th style="text-align:left;">Description</th>
                            <th style="text-align:center;">Time Limit</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $index => $quiz)
                            <tr>
                                <td style="color:#475569;font-size:0.8rem;width:50px;">{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('admin.quiz.edit', $quiz->id) }}" style="color:#0f172a;font-weight:600;font-size:0.9rem;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#4f46e5'" onmouseout="this.style.color='#0f172a'">
                                        {{ $quiz->title }}
                                    </a>
                                </td>
                                <td style="color:#64748b;font-size:0.75rem;max-width:180px;word-wrap:break-word;white-space:normal;line-height:1.4;">
                                    {{ $quiz->description ? Str::limit($quiz->description, 60) : '—' }}
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge-yellow">⏱ {{ $quiz->time_limit }} min</span>
                                </td>
                                <td style="text-align:center;">
                                    <div style="display:flex;align-items:center;justify-content:center;gap:8px;">
                                        <a href="{{ route('admin.quiz.edit', $quiz->id) }}"
                                           style="background:rgba(129,140,248,0.15);color:#818cf8;border:1px solid rgba(129,140,248,0.2);border-radius:8px;padding:6px 14px;font-size:0.75rem;font-weight:600;text-decoration:none;transition:all 0.2s;display:inline-flex;align-items:center;gap:4px;"
                                           onmouseover="this.style.background='rgba(129,140,248,0.25)';this.style.transform='translateY(-1px)';"
                                           onmouseout="this.style.background='rgba(129,140,248,0.15)';this.style.transform='none';">
                                            🔧 Manage Quiz
                                        </a>
                                        <a href="{{ route('admin.quiz.delete', $quiz->id) }}"
                                           onclick="return confirm('Are you sure you want to delete this quiz? All associated questions and results will be permanently removed!')"
                                           style="background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.2);border-radius:8px;padding:6px 14px;font-size:0.75rem;font-weight:600;text-decoration:none;transition:all 0.2s;display:inline-flex;align-items:center;gap:4px;"
                                           onmouseover="this.style.background='rgba(239,68,68,0.25)';this.style.transform='translateY(-1px)';"
                                           onmouseout="this.style.background='rgba(239,68,68,0.15)';this.style.transform='none';">
                                            🗑 Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:60px;color:#475569;">
                                    <div style="font-size:3rem;margin-bottom:12px;">📚</div>
                                    <p style="font-size:1rem;color:#64748b;margin-bottom:8px;">Koi quiz nahi bana abhi tak</p>
                                    <a href="{{ route('admin.quiz.create') }}" class="btn-primary" style="text-decoration:none;display:inline-flex;align-items:center;gap:8px;margin-top:8px;">
                                        Create First Quiz →
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>