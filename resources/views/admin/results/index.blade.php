<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="gradient-text" style="font-size:1.6rem;font-weight:800;margin:0;">Quiz Results</h2>
                <p style="color:#64748b;font-size:0.85rem;margin-top:2px;">Overview of students attempts and scoring distributions</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary" style="text-decoration:none;">
                ← Dashboard
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-7xl mx-auto" style="padding:0 24px;">

            {{-- Results Table --}}
            <div class="glass-card" style="overflow-x:auto;width:100%;">
                <table class="dark-table" style="width:100%;border-collapse:collapse;min-width:650px;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">#</th>
                            <th style="text-align:left;">Quiz Title</th>
                            <th style="text-align:center;">Attempts</th>
                            <th style="text-align:center;">✅ Pass</th>
                            <th style="text-align:center;">❌ Fail</th>
                            <th style="text-align:center;">Avg Score</th>
                            <th style="text-align:center;">Pass Rate</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $index => $quiz)
                            <tr>
                                <td style="color:#475569;font-size:0.8rem;width:50px;">{{ $index + 1 }}</td>
                                <td>
                                    <span style="color:#0f172a;font-weight:600;font-size:0.9rem;">{{ $quiz->title }}</span>
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge-blue">
                                        {{ $quiz->total_attempts }} attempts
                                    </span>
                                </td>
                                <td style="text-align:center;font-weight:700;color:#16a34a;">{{ $quiz->pass_count }}</td>
                                <td style="text-align:center;font-weight:700;color:#dc2626;">{{ $quiz->fail_count }}</td>
                                <td style="text-align:center;">
                                    @if(($quiz->avg_score ?? 0) >= 70)
                                        <span class="badge-green">{{ round($quiz->avg_score ?? 0) }}%</span>
                                    @elseif(($quiz->avg_score ?? 0) >= 50)
                                        <span class="badge-yellow">{{ round($quiz->avg_score ?? 0) }}%</span>
                                    @else
                                        <span class="badge-red">{{ round($quiz->avg_score ?? 0) }}%</span>
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    @php
                                        $passRate = $quiz->total_attempts > 0
                                            ? round(($quiz->pass_count / $quiz->total_attempts) * 100)
                                            : 0;
                                    @endphp
                                    <div style="display:flex;align-items:center;gap:10px;justify-content:center;">
                                        <div style="flex-grow:1;max-width:100px;background:rgba(15,23,42,0.06);border-radius:9999px;height:8px;overflow:hidden;">
                                            <div style="background:#16a34a;height:8px;border-radius:9999px;width: {{ $passRate }}%"></div>
                                        </div>
                                        <span style="font-size:0.8rem;color:#475569;font-weight:600;width:36px;text-align:left;">{{ $passRate }}%</span>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <a href="{{ route('admin.quiz.results', $quiz->id) }}"
                                       style="background:rgba(99,102,241,0.15);color:#4f46e5;border:1px solid rgba(99,102,241,0.2);border-radius:8px;padding:6px 12px;font-size:0.75rem;font-weight:600;text-decoration:none;transition:all 0.2s;"
                                       onmouseover="this.style.background='rgba(99,102,241,0.25)'"
                                       onmouseout="this.style.background='rgba(99,102,241,0.15)'">
                                        👁 View All
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center;padding:60px;color:#475569;">
                                    <div style="font-size:3rem;margin-bottom:12px;">📊</div>
                                    <p style="color:#64748b;font-size:1rem;margin:0;">No quizzes attempted yet</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>