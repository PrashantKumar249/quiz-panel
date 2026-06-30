<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="gradient-text" style="font-size:1.6rem;font-weight:800;margin:0;">Results — {{ $quiz->title }}</h2>
                <p style="color:#64748b;font-size:0.85rem;margin-top:2px;">Detailed view of student scores for this quiz</p>
            </div>
            <a href="{{ route('admin.results') }}" class="btn-secondary" style="text-decoration:none;">
                ← All Quizzes
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-7xl mx-auto" style="padding:0 24px;display:flex;flex-direction:column;gap:24px;">

            {{-- Quiz Info + Stats --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:20px;">
                <div class="glass-card" style="padding:20px;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#6366f1;line-height:1;margin:0;">{{ $attempts->count() }}</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;margin-bottom:0;font-weight:600;text-transform:uppercase;">Total Attempts</p>
                </div>
                <div class="glass-card" style="padding:20px;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#16a34a;line-height:1;margin:0;">{{ $attempts->where('score', '>=', 50)->count() }}</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;margin-bottom:0;font-weight:600;text-transform:uppercase;">Passed</p>
                </div>
                <div class="glass-card" style="padding:20px;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#dc2626;line-height:1;margin:0;">{{ $attempts->where('score', '<', 50)->count() }}</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;margin-bottom:0;font-weight:600;text-transform:uppercase;">Failed</p>
                </div>
                <div class="glass-card" style="padding:20px;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#2563eb;line-height:1;margin:0;">{{ round($attempts->avg('score') ?? 0) }}%</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;margin-bottom:0;font-weight:600;text-transform:uppercase;">Avg Score</p>
                </div>
            </div>

            {{-- Results Table --}}
            <div class="glass-card" style="overflow-x:auto;width:100%;">
                <table class="dark-table" style="width:100%;border-collapse:collapse;min-width:750px;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">#</th>
                            <th style="text-align:left;">Student</th>
                            <th style="text-align:left;">Email</th>
                            <th style="text-align:center;">Total Q</th>
                            <th style="text-align:center;">✅ Correct</th>
                            <th style="text-align:center;">❌ Wrong</th>
                            <th style="text-align:center;">Score</th>
                            <th style="text-align:center;">Date</th>
                            <th style="text-align:center;">Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attempts as $index => $attempt)
                            <tr>
                                <td style="color:#475569;font-size:0.8rem;width:50px;">{{ $index + 1 }}</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div class="avatar" style="width:30px;height:30px;font-size:0.75rem;">
                                            {{ strtoupper(substr($attempt->user->name, 0, 1)) }}
                                        </div>
                                        <span style="color:#0f172a;font-weight:600;font-size:0.9rem;">{{ $attempt->user->name }}</span>
                                    </div>
                                </td>
                                <td style="color:#64748b;font-size:0.85rem;">{{ $attempt->user->email }}</td>
                                <td style="text-align:center;font-weight:600;">{{ $attempt->total_questions }}</td>
                                <td style="text-align:center;font-weight:700;color:#16a34a;">{{ $attempt->correct_answers }}</td>
                                <td style="text-align:center;font-weight:700;color:#dc2626;">{{ $attempt->wrong_answers }}</td>
                                <td style="text-align:center;">
                                    @if($attempt->score >= 50)
                                        <span class="badge-green">{{ $attempt->score }}% ✅</span>
                                    @else
                                        <span class="badge-red">{{ $attempt->score }}% ❌</span>
                                    @endif
                                </td>
                                <td style="text-align:center;color:#64748b;font-size:0.8rem;">
                                    {{ $attempt->created_at->format('d M Y, h:i A') }}
                                </td>
                                <td style="text-align:center;">
                                    <a href="{{ route('admin.attempt.detail', $attempt->id) }}"
                                       style="background:rgba(99,102,241,0.15);color:#4f46e5;border:1px solid rgba(99,102,241,0.2);border-radius:8px;padding:6px 12px;font-size:0.75rem;font-weight:600;text-decoration:none;transition:all 0.2s;"
                                       onmouseover="this.style.background='rgba(99,102,241,0.25)'"
                                       onmouseout="this.style.background='rgba(99,102,241,0.15)'">
                                        👁 Review
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" style="text-align:center;padding:60px;color:#475569;">
                                    <div style="font-size:3rem;margin-bottom:12px;">📋</div>
                                    <p style="color:#64748b;font-size:1rem;margin:0;">No attempts recorded for this quiz yet</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>