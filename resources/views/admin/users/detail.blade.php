<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="gradient-text" style="font-size:1.4rem;font-weight:800;margin:0;">User Detail</h2>
                <p style="color:#64748b;font-size:0.8rem;margin-top:2px;">{{ $user->name }}'s full profile & history</p>
            </div>
            <a href="{{ route('admin.users') }}" class="btn-secondary" style="text-decoration:none;">← Users List</a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-5xl mx-auto" style="padding:0 24px;">

            {{-- User Info Card --}}
            <div class="glass-card" style="padding:28px;margin-bottom:20px;">
                <div style="display:flex;align-items:center;gap:20px;">
                    <div class="avatar" style="width:70px;height:70px;font-size:1.8rem;box-shadow:0 0 30px rgba(99,102,241,0.4);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div style="flex:1;">
                        <h3 style="color:#e2e8f0;font-size:1.3rem;font-weight:700;margin:0 0 4px;">{{ $user->name }}</h3>
                        <p style="color:#64748b;font-size:0.9rem;margin:0 0 10px;">{{ $user->email }}</p>
                        <div style="display:flex;gap:10px;flex-wrap:wrap;">
                            @if($user->is_active)
                                <span class="badge-green">● Active</span>
                            @else
                                <span class="badge-red">● Blocked</span>
                            @endif
                            <span style="background:rgba(100,116,139,0.2);color:#94a3b8;border-radius:20px;padding:4px 12px;font-size:0.75rem;font-weight:600;">
                                Joined {{ $user->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            @php
                $completedAttempts = $user->quizAttempts->where('status', 'completed');
                $avgScore = $completedAttempts->avg('score') ?? 0;
                $bestScore = $completedAttempts->max('score') ?? 0;
            @endphp

            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px;">
                <div class="glass-card stat-glow-blue" style="padding:20px;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#818cf8;line-height:1;">{{ $completedAttempts->count() }}</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;font-weight:500;">Quizzes Attempted</p>
                </div>
                <div class="glass-card" style="padding:20px;text-align:center;box-shadow:0 0 30px rgba(56,189,248,0.12);">
                    <p style="font-size:2rem;font-weight:800;color:#38bdf8;line-height:1;">{{ round($avgScore) }}%</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;font-weight:500;">Average Score</p>
                </div>
                <div class="glass-card stat-glow-green" style="padding:20px;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#4ade80;line-height:1;">{{ $bestScore }}%</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;font-weight:500;">Best Score</p>
                </div>
            </div>

            {{-- All Attempts Table --}}
            <div class="glass-card" style="overflow:hidden;">
                <div style="padding:20px 24px;border-bottom:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;gap:10px;">
                    <div style="width:8px;height:8px;background:linear-gradient(135deg,#6366f1,#a855f7);border-radius:50%;"></div>
                    <h3 style="color:#e2e8f0;font-weight:700;font-size:0.95rem;margin:0;">All Quiz Attempts</h3>
                </div>
                <table class="dark-table" style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">#</th>
                            <th style="text-align:left;">Quiz</th>
                            <th style="text-align:center;">Total Q</th>
                            <th style="text-align:center;">Correct</th>
                            <th style="text-align:center;">Wrong</th>
                            <th style="text-align:center;">Score</th>
                            <th style="text-align:center;">Date</th>
                            <th style="text-align:center;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($completedAttempts->sortByDesc('created_at') as $index => $attempt)
                            <tr>
                                <td style="color:#475569;font-size:0.8rem;">{{ $index + 1 }}</td>
                                <td style="color:#e2e8f0;font-weight:600;font-size:0.9rem;">{{ $attempt->quiz->title }}</td>
                                <td style="text-align:center;color:#94a3b8;">{{ $attempt->total_questions }}</td>
                                <td style="text-align:center;color:#4ade80;font-weight:700;">{{ $attempt->correct_answers }}</td>
                                <td style="text-align:center;color:#f87171;font-weight:700;">{{ $attempt->wrong_answers }}</td>
                                <td style="text-align:center;">
                                    <span style="border-radius:20px;padding:4px 12px;font-size:0.75rem;font-weight:700;
                                        {{ $attempt->score >= 70 ? 'background:rgba(34,197,94,0.15);color:#4ade80;' : ($attempt->score >= 50 ? 'background:rgba(234,179,8,0.15);color:#fbbf24;' : 'background:rgba(239,68,68,0.15);color:#f87171;') }}">
                                        {{ $attempt->score }}%
                                    </span>
                                </td>
                                <td style="text-align:center;color:#475569;font-size:0.8rem;">{{ $attempt->created_at->format('d M Y') }}</td>
                                <td style="text-align:center;">
                                    <a href="{{ route('admin.attempt.detail', $attempt->id) }}"
                                       style="background:rgba(99,102,241,0.15);color:#818cf8;border:1px solid rgba(99,102,241,0.2);border-radius:8px;padding:5px 12px;font-size:0.75rem;font-weight:600;text-decoration:none;transition:all 0.2s;">
                                        👁 Review
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center;padding:40px;color:#475569;">
                                    Is user ne abhi koi quiz attempt nahi kiya
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>