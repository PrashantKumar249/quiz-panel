<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="gradient-text" style="font-size:1.6rem;font-weight:800;margin:0;">My Quiz History</h2>
                <p style="color:#64748b;font-size:0.85rem;margin-top:2px;">Track your past performance and test results</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-secondary" style="text-decoration:none;">
                ← Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-7xl mx-auto" style="padding:0 24px;">

            @if($history->isEmpty())
                <div class="glass-card" style="padding:60px;text-align:center;color:#475569;">
                    <div style="font-size:3.5rem;margin-bottom:16px;">📭</div>
                    <p style="font-size:1.1rem;color:#cbd5e1;margin-bottom:8px;font-weight:600;">No Attempts Yet</p>
                    <p style="font-size:0.85rem;color:#64748b;margin-bottom:20px;">Aapne abhi tak koi quiz attempt nahi kiya hai.</p>
                    <a href="{{ route('dashboard') }}" class="btn-primary" style="text-decoration:none;">
                        Quiz Dene Jao →
                    </a>
                </div>
            @else
                {{-- TABLE WRAPPER --}}
                <div class="glass-card" style="overflow:hidden;margin-bottom:32px;">
                    <table class="dark-table" style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th style="text-align:left;">#</th>
                                <th style="text-align:left;">Quiz Name</th>
                                <th style="text-align:center;">Total Q</th>
                                <th style="text-align:center;">✅ Correct</th>
                                <th style="text-align:center;">❌ Wrong</th>
                                <th style="text-align:center;">Score</th>
                                <th style="text-align:center;">Date & Time</th>
                                <th style="text-align:center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $index => $attempt)
                                <tr>
                                    <td style="color:#475569;font-size:0.8rem;width:50px;">{{ $index + 1 }}</td>
                                    <td>
                                        <span style="color:#e2e8f0;font-weight:600;font-size:0.9rem;">{{ $attempt->quiz->title }}</span>
                                    </td>
                                    <td style="text-align:center;font-weight:600;">
                                        {{ $attempt->total_questions }}
                                    </td>
                                    <td style="text-align:center;font-weight:700;color:#4ade80;">
                                        {{ $attempt->correct_answers }}
                                    </td>
                                    <td style="text-align:center;font-weight:700;color:#f87171;">
                                        {{ $attempt->wrong_answers }}
                                    </td>
                                    <td style="text-align:center;">
                                        @if($attempt->score >= 70)
                                            <span class="badge-green">🏆 {{ $attempt->score }}%</span>
                                        @elseif($attempt->score >= 40)
                                            <span class="badge-yellow">⚡ {{ $attempt->score }}%</span>
                                        @else
                                            <span class="badge-red">⚠️ {{ $attempt->score }}%</span>
                                        @endif
                                    </td>
                                    <td style="text-align:center;color:#64748b;font-size:0.8rem;">
                                        {{ $attempt->created_at->format('d M Y, h:i A') }}
                                    </td>
                                    <td style="text-align:center;">
                                        <a href="{{ route('user.quiz.result', $attempt->id) }}"
                                           style="background:rgba(99,102,241,0.15);color:#818cf8;border:1px solid rgba(99,102,241,0.2);border-radius:8px;padding:6px 12px;font-size:0.75rem;font-weight:600;text-decoration:none;transition:all 0.2s;"
                                           onmouseover="this.style.background='rgba(99,102,241,0.25)'"
                                           onmouseout="this.style.background='rgba(99,102,241,0.15)'">
                                            🔍 View Result
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- SUMMARY STATS --}}
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;">
                    
                    <div class="glass-card" style="padding:24px;text-align:center;transition:all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                        <p style="color:#64748b;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-top:0;margin-bottom:8px;">Total Attempts</p>
                        <p style="font-size:2.5rem;font-weight:800;color:#818cf8;line-height:1;margin:0;">{{ $history->count() }}</p>
                    </div>

                    <div class="glass-card" style="padding:24px;text-align:center;transition:all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                        <p style="color:#64748b;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-top:0;margin-bottom:8px;">Average Score</p>
                        <p style="font-size:2.5rem;font-weight:800;color:#22c55e;line-height:1;margin:0;">{{ round($history->avg('score')) }}%</p>
                    </div>

                    <div class="glass-card" style="padding:24px;text-align:center;transition:all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                        <p style="color:#64748b;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-top:0;margin-bottom:8px;">Best Score</p>
                        <p style="font-size:2.5rem;font-weight:800;color:#eab308;line-height:1;margin:0;">{{ $history->max('score') }}%</p>
                    </div>

                </div>
            @endif

        </div>
    </div>
</x-app-layout>