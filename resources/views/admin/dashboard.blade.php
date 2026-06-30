<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="gradient-text" style="font-size:1.6rem;font-weight:800;margin:0;">Admin Dashboard</h2>
                <p style="color:#64748b;font-size:0.85rem;margin-top:2px;">Welcome back, {{ Auth::user()->name }} 👋</p>
            </div>
            <a href="{{ route('admin.quiz.create') }}" class="btn-primary" style="text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                New Quiz
            </a>
        </div>
    </x-slot>

    {{-- Chart.js CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

    <div style="padding:32px 0;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="padding-left:24px;padding-right:24px;">

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert-success" style="margin-bottom:24px;display:flex;align-items:center;gap:10px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- ====== STATS CARDS ====== --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-bottom:24px;">

                <div class="glass-card stat-glow-blue" style="padding:24px;display:flex;align-items:center;gap:16px;transition:all 0.25s;"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(99,102,241,0.15)';"
                     onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(99,102,241,0.06)';">
                    <div style="width:52px;height:52px;background:linear-gradient(135deg,rgba(99,102,241,0.15),rgba(99,102,241,0.05));border-radius:14px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(99,102,241,0.2);flex-shrink:0;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <p style="font-size:2rem;font-weight:800;color:#0f172a;line-height:1;margin:0;">{{ $totalUsers }}</p>
                        <p style="color:#475569;font-size:0.8rem;margin-top:6px;margin-bottom:0;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Total Users</p>
                    </div>
                </div>

                <div class="glass-card stat-glow-purple" style="padding:24px;display:flex;align-items:center;gap:16px;transition:all 0.25s;"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(168,85,247,0.15)';"
                     onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(168,85,247,0.06)';">
                    <div style="width:52px;height:52px;background:linear-gradient(135deg,rgba(168,85,247,0.15),rgba(168,85,247,0.05));border-radius:14px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(168,85,247,0.2);flex-shrink:0;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    </div>
                    <div>
                        <p style="font-size:2rem;font-weight:800;color:#0f172a;line-height:1;margin:0;">{{ $totalQuizzes }}</p>
                        <p style="color:#475569;font-size:0.8rem;margin-top:6px;margin-bottom:0;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Total Quizzes</p>
                    </div>
                </div>

                <div class="glass-card" style="padding:24px;display:flex;align-items:center;gap:16px;border:1px solid rgba(234,179,8,0.15);box-shadow:0 4px 20px rgba(234,179,8,0.06);transition:all 0.25s;"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(234,179,8,0.15)';"
                     onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(234,179,8,0.06)';">
                    <div style="width:52px;height:52px;background:linear-gradient(135deg,rgba(234,179,8,0.15),rgba(234,179,8,0.05));border-radius:14px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(234,179,8,0.2);flex-shrink:0;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <div>
                        <p style="font-size:2rem;font-weight:800;color:#0f172a;line-height:1;margin:0;">{{ $totalQuestions }}</p>
                        <p style="color:#475569;font-size:0.8rem;margin-top:6px;margin-bottom:0;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Total Questions</p>
                    </div>
                </div>

                <div class="glass-card stat-glow-green" style="padding:24px;display:flex;align-items:center;gap:16px;transition:all 0.25s;"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(34,197,94,0.15)';"
                     onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(34,197,94,0.06)';">
                    <div style="width:52px;height:52px;background:linear-gradient(135deg,rgba(34,197,94,0.15),rgba(34,197,94,0.05));border-radius:14px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(34,197,94,0.2);flex-shrink:0;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <div>
                        <p style="font-size:2rem;font-weight:800;color:#0f172a;line-height:1;margin:0;">{{ $totalAttempts }}</p>
                        <p style="color:#475569;font-size:0.8rem;margin-top:6px;margin-bottom:0;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Total Attempts</p>
                    </div>
                </div>

            </div>

            {{-- AVG SCORE + PASS/FAIL CARDS --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:24px;">

                <div class="glass-card" style="padding:24px;position:relative;border:1px solid rgba(99,102,241,0.25);box-shadow:0 0 25px rgba(99,102,241,0.08);overflow:hidden;transition:all 0.25s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                    <div style="position:absolute;top:-50px;right:-50px;width:120px;height:120px;background:rgba(99,102,241,0.08);border-radius:50%;filter:blur(30px);"></div>
                    <p style="color:#4f46e5;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:8px;margin-top:0;">Average Score</p>
                    <p style="color:#0f172a;font-size:2.8rem;font-weight:800;line-height:1;margin:0;">{{ round($avgScore) }}%</p>
                    <p style="color:#64748b;font-size:0.75rem;margin-top:8px;margin-bottom:0;">Across all attempts</p>
                </div>

                <div class="glass-card" style="padding:24px;position:relative;border:1px solid rgba(34,197,94,0.25);box-shadow:0 0 25px rgba(34,197,94,0.08);overflow:hidden;transition:all 0.25s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                    <div style="position:absolute;top:-50px;right:-50px;width:120px;height:120px;background:rgba(34,197,94,0.08);border-radius:50%;filter:blur(30px);"></div>
                    <p style="color:#16a34a;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:8px;margin-top:0;">✅ Passed (≥50%)</p>
                    <p style="color:#0f172a;font-size:2.8rem;font-weight:800;line-height:1;margin:0;">{{ $passCount }}</p>
                    <p style="color:#64748b;font-size:0.75rem;margin-top:8px;margin-bottom:0;">
                        {{ $totalAttempts > 0 ? round(($passCount / $totalAttempts) * 100) : 0 }}% pass rate
                    </p>
                </div>

                <div class="glass-card" style="padding:24px;position:relative;border:1px solid rgba(239,68,68,0.25);box-shadow:0 0 25px rgba(239,68,68,0.08);overflow:hidden;transition:all 0.25s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                    <div style="position:absolute;top:-50px;right:-50px;width:120px;height:120px;background:rgba(239,68,68,0.08);border-radius:50%;filter:blur(30px);"></div>
                    <p style="color:#dc2626;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:8px;margin-top:0;">❌ Failed (&lt;50%)</p>
                    <p style="color:#0f172a;font-size:2.8rem;font-weight:800;line-height:1;margin:0;">{{ $failCount }}</p>
                    <p style="color:#64748b;font-size:0.75rem;margin-top:8px;margin-bottom:0;">
                        {{ $totalAttempts > 0 ? round(($failCount / $totalAttempts) * 100) : 0 }}% fail rate
                    </p>
                </div>

            </div>

            {{-- CHARTS ROW --}}
            <div style="display:grid;grid-template-columns:1fr;" class="lg-grid-2-cols">

                {{-- Chart 1: Last 7 Days --}}
                <div class="glass-card" style="padding:24px;min-width:0;overflow:hidden;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                        <div>
                            <h3 style="color:#0f172a;font-weight:700;font-size:1rem;margin:0;">Weekly Attempts</h3>
                            <p style="color:#64748b;font-size:0.75rem;margin-top:3px;margin-bottom:0;">Last 7 days overview</p>
                        </div>
                        <div style="background:rgba(99,102,241,0.1);border-radius:8px;padding:6px 12px;">
                            <span style="color:#4f46e5;font-size:0.75rem;font-weight:600;">📈 Activity</span>
                        </div>
                    </div>
                    <div style="height: 180px; position: relative;">
                        <canvas id="weeklyChart"></canvas>
                    </div>
                </div>

                {{-- Chart 2: Quiz-wise --}}
                <div class="glass-card" style="padding:24px;min-width:0;overflow:hidden;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                        <div>
                            <h3 style="color:#0f172a;font-weight:700;font-size:1rem;margin:0;">Quiz Distribution</h3>
                            <p style="color:#64748b;font-size:0.75rem;margin-top:3px;margin-bottom:0;">Attempts per quiz</p>
                        </div>
                        <div style="background:rgba(168,85,247,0.1);border-radius:8px;padding:6px 12px;">
                            <span style="color:#7c3aed;font-size:0.75rem;font-weight:600;">🏆 Ranking</span>
                        </div>
                    </div>
                    <div style="height: 180px; position: relative;">
                        <canvas id="quizChart"></canvas>
                    </div>
                </div>

            </div>

            {{-- QUICK ACTIONS GRID --}}
            <div class="glass-card" style="padding:28px;margin-top:24px;">
                <h3 style="color:#0f172a;font-weight:700;font-size:1.1rem;margin:0 0 20px 0;display:flex;align-items:center;gap:8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    Quick Actions Panel
                </h3>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;">
                    
                    <a href="{{ route('admin.quiz.create') }}" style="text-decoration:none;display:flex;align-items:center;gap:16px;padding:18px;background:rgba(15,23,42,0.02);border:1px solid rgba(15,23,42,0.05);border-radius:12px;transition:all 0.2s;" onmouseover="this.style.background='rgba(99,102,241,0.04)';this.style.borderColor='rgba(99,102,241,0.2)';this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(15,23,42,0.02)';this.style.borderColor='rgba(15,23,42,0.05)';this.style.transform='none';">
                        <div style="width:42px;height:42px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow: 0 4px 10px rgba(99,102,241,0.25);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                        <div>
                            <h4 style="color:#0f172a;font-size:0.9rem;font-weight:700;margin:0;">Create Quiz</h4>
                            <p style="color:#64748b;font-size:0.75rem;margin:4px 0 0 0;line-height:1.2;">Add new quiz and set questions</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.quiz.list') }}" style="text-decoration:none;display:flex;align-items:center;gap:16px;padding:18px;background:rgba(15,23,42,0.02);border:1px solid rgba(15,23,42,0.05);border-radius:12px;transition:all 0.2s;" onmouseover="this.style.background='rgba(139,92,246,0.04)';this.style.borderColor='rgba(139,92,246,0.2)';this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(15,23,42,0.02)';this.style.borderColor='rgba(15,23,42,0.05)';this.style.transform='none';">
                        <div style="width:42px;height:42px;background:linear-gradient(135deg,#8b5cf6,#ec4899);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow: 0 4px 10px rgba(139,92,246,0.25);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </div>
                        <div>
                            <h4 style="color:#0f172a;font-size:0.9rem;font-weight:700;margin:0;">Manage Quizzes</h4>
                            <p style="color:#64748b;font-size:0.75rem;margin:4px 0 0 0;line-height:1.2;">Configure active and draft quizzes</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.users') }}" style="text-decoration:none;display:flex;align-items:center;gap:16px;padding:18px;background:rgba(15,23,42,0.02);border:1px solid rgba(15,23,42,0.05);border-radius:12px;transition:all 0.2s;" onmouseover="this.style.background='rgba(59,130,246,0.04)';this.style.borderColor='rgba(59,130,246,0.2)';this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(15,23,42,0.02)';this.style.borderColor='rgba(15,23,42,0.05)';this.style.transform='none';">
                        <div style="width:42px;height:42px;background:linear-gradient(135deg,#3b82f6,#06b6d4);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow: 0 4px 10px rgba(59,130,246,0.25);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div>
                            <h4 style="color:#0f172a;font-size:0.9rem;font-weight:700;margin:0;">Manage Users</h4>
                            <p style="color:#64748b;font-size:0.75rem;margin:4px 0 0 0;line-height:1.2;">Block/unblock and monitor students</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.results') }}" style="text-decoration:none;display:flex;align-items:center;gap:16px;padding:18px;background:rgba(15,23,42,0.02);border:1px solid rgba(15,23,42,0.05);border-radius:12px;transition:all 0.2s;" onmouseover="this.style.background='rgba(16,185,129,0.04)';this.style.borderColor='rgba(16,185,129,0.2)';this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(15,23,42,0.02)';this.style.borderColor='rgba(15,23,42,0.05)';this.style.transform='none';">
                        <div style="width:42px;height:42px;background:linear-gradient(135deg,#10b981,#059669);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow: 0 4px 10px rgba(16,185,129,0.25);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </div>
                        <div>
                            <h4 style="color:#0f172a;font-size:0.9rem;font-weight:700;margin:0;">View Results</h4>
                            <p style="color:#64748b;font-size:0.75rem;margin:4px 0 0 0;line-height:1.2;">Track marks, passes and fail stats</p>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>

    <script>
        Chart.defaults.color = '#475569';
        Chart.defaults.borderColor = 'rgba(15,23,42,0.05)';

        // Weekly Attempts Chart
        const weeklyLabels = @json($weeklyData->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M')));
        const weeklyCounts = @json($weeklyData->pluck('count'));

        new Chart(document.getElementById('weeklyChart'), {
            type: 'line',
            data: {
                labels: weeklyLabels.length ? weeklyLabels : ['No Data'],
                datasets: [{
                    label: 'Attempts',
                    data: weeklyCounts.length ? weeklyCounts : [0],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79,70,229,0.05)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4f46e5',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { color: 'rgba(15,23,42,0.04)' }, ticks: { color: '#475569' } },
                    y: { beginAtZero: true, ticks: { precision: 0, color: '#475569' }, grid: { color: 'rgba(15,23,42,0.04)' } }
                }
            }
        });

        // Quiz-wise Chart
        const quizLabels = @json($quizWiseData->pluck('title'));
        const quizCounts = @json($quizWiseData->pluck('attempts_count'));
        const colors = ['#4f46e5','#7c3aed','#10b981','#d97706','#dc2626','#06b6d4','#6366f1'];

        new Chart(document.getElementById('quizChart'), {
            type: 'doughnut',
            data: {
                labels: quizLabels.length ? quizLabels : ['No Quizzes'],
                datasets: [{
                    data: quizCounts.length ? quizCounts : [1],
                    backgroundColor: colors.slice(0, quizLabels.length || 1),
                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#475569', font: { size: 11 }, padding: 16, boxWidth: 12, borderRadius: 4 }
                    }
                }
            }
        });
    </script>

    <style>
        @media(min-width: 1024px) {
            .lg-grid-2-cols {
                grid-template-columns: 1fr 1fr !important;
                gap: 24px !important;
            }
        }
    </style>
</x-app-layout>