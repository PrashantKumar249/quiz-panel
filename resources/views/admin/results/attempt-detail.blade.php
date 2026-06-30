<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="gradient-text" style="font-size:1.6rem;font-weight:800;margin:0;">🔍 Answer Review</h2>
                <p style="color:#64748b;font-size:0.85rem;margin-top:2px;">Student Performance Details: {{ $attempt->user->name }}</p>
            </div>
            <a href="{{ route('admin.quiz.results', $attempt->quiz_id) }}" class="btn-secondary" style="text-decoration:none;">
                ← Back to Results
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-4xl mx-auto" style="padding:0 24px;display:flex;flex-direction:column;gap:28px;">

            {{-- Summary Banner Card --}}
            <div class="glass-card" style="overflow:hidden;border:none;box-shadow:0 10px 30px rgba(15,23,42,0.05);padding:0;">
                
                {{-- Dynamic Top Banner --}}
                @if($attempt->score >= 50)
                    <div style="background:linear-gradient(135deg,#10b981,#059669);padding:24px 32px;color:white;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;">
                        <div>
                            <p style="margin:0;font-size:0.8rem;color:rgba(255,255,255,0.75);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Student Name</p>
                            <h3 style="margin:4px 0 0 0;font-size:1.4rem;font-weight:800;">{{ $attempt->user->name }}</h3>
                            <p style="margin:4px 0 0 0;font-size:0.85rem;color:rgba(255,255,255,0.85);">{{ $attempt->user->email }}</p>
                        </div>
                        <div style="text-align:right;" class="banner-right">
                            <p style="margin:0;font-size:0.8rem;color:rgba(255,255,255,0.75);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Quiz Title</p>
                            <h4 style="margin:4px 0 0 0;font-size:1.15rem;font-weight:800;">{{ $attempt->quiz->title }}</h4>
                            <p style="margin:4px 0 0 0;font-size:0.85rem;color:rgba(255,255,255,0.85);">{{ $attempt->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>
                @else
                    <div style="background:linear-gradient(135deg,#ef4444,#dc2626);padding:24px 32px;color:white;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;">
                        <div>
                            <p style="margin:0;font-size:0.8rem;color:rgba(255,255,255,0.75);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Student Name</p>
                            <h3 style="margin:4px 0 0 0;font-size:1.4rem;font-weight:800;">{{ $attempt->user->name }}</h3>
                            <p style="margin:4px 0 0 0;font-size:0.85rem;color:rgba(255,255,255,0.85);">{{ $attempt->user->email }}</p>
                        </div>
                        <div style="text-align:right;" class="banner-right">
                            <p style="margin:0;font-size:0.8rem;color:rgba(255,255,255,0.75);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Quiz Title</p>
                            <h4 style="margin:4px 0 0 0;font-size:1.15rem;font-weight:800;">{{ $attempt->quiz->title }}</h4>
                            <p style="margin:4px 0 0 0;font-size:0.85rem;color:rgba(255,255,255,0.85);">{{ $attempt->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>
                @endif

                {{-- Metric Box Results Grid --}}
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));background:#ffffff;border-top:1px solid rgba(15,23,42,0.05);">
                    
                    <div style="padding:20px;text-align:center;border-right:1px solid rgba(15,23,42,0.05);border-bottom:1px solid rgba(15,23,42,0.05);">
                        <p style="font-size:2.2rem;font-weight:900;color:#4f46e5;line-height:1;margin:0;">{{ $attempt->score }}%</p>
                        <p style="color:#64748b;font-size:0.75rem;margin-top:8px;margin-bottom:0;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Final Score</p>
                    </div>

                    <div style="padding:20px;text-align:center;border-right:1px solid rgba(15,23,42,0.05);border-bottom:1px solid rgba(15,23,42,0.05);">
                        <p style="font-size:2.2rem;font-weight:900;color:#0f172a;line-height:1;margin:0;">{{ $attempt->total_questions }}</p>
                        <p style="color:#64748b;font-size:0.75rem;margin-top:8px;margin-bottom:0;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Total Questions</p>
                    </div>

                    <div style="padding:20px;text-align:center;border-right:1px solid rgba(15,23,42,0.05);border-bottom:1px solid rgba(15,23,42,0.05);">
                        <p style="font-size:2.2rem;font-weight:900;color:#16a34a;line-height:1;margin:0;">{{ $attempt->correct_answers }}</p>
                        <p style="color:#64748b;font-size:0.75rem;margin-top:8px;margin-bottom:0;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Correct Answers</p>
                    </div>

                    <div style="padding:20px;text-align:center;border-bottom:1px solid rgba(15,23,42,0.05);">
                        <p style="font-size:2.2rem;font-weight:900;color:#ef4444;line-height:1;margin:0;">{{ $attempt->wrong_answers }}</p>
                        <p style="color:#64748b;font-size:0.75rem;margin-top:8px;margin-bottom:0;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Wrong Answers</p>
                    </div>

                </div>
            </div>

            {{-- Question Review Grid --}}
            <div>
                <h3 style="color:#0f172a;font-weight:800;font-size:1.15rem;margin:0 0 16px 0;display:flex;align-items:center;gap:8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    Question-wise Answer Review
                </h3>

                <div style="display:flex;flex-direction:column;gap:18px;">
                    @foreach($attempt->answers as $index => $answer)
                        <div class="glass-card" style="padding:0;overflow:hidden;border:1px solid {{ $answer->is_correct ? 'rgba(22,163,74,0.18)' : 'rgba(220,38,38,0.18)' }};box-shadow:0 4px 15px rgba(15,23,42,0.02);">
                            
                            {{-- Header --}}
                            <div style="background:{{ $answer->is_correct ? 'rgba(22,163,74,0.04)' : 'rgba(220,38,38,0.04)' }};border-bottom:1px solid {{ $answer->is_correct ? 'rgba(22,163,74,0.08)' : 'rgba(220,38,38,0.08)' }};padding:12px 20px;display:flex;justify-content:space-between;align-items:center;">
                                <span style="font-size:0.8rem;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.04em;">Question {{ $index + 1 }}</span>
                                <span style="font-size:0.8rem;font-weight:700;color:{{ $answer->is_correct ? '#16a34a' : '#ef4444' }};display:flex;align-items:center;gap:4px;">
                                    {!! $answer->is_correct 
                                        ? '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> Correct' 
                                        : '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Wrong' !!}
                                </span>
                            </div>

                            {{-- Body --}}
                            <div style="padding:20px;">
                                <p style="color:#0f172a;font-weight:600;font-size:0.95rem;margin-top:0;margin-bottom:16px;line-height:1.5;">{{ $answer->question->question }}</p>

                                <div style="display:grid;grid-template-columns:1fr;gap:10px;" class="sm-grid-cols-2">
                                    @foreach(['A' => $answer->question->option_a, 'B' => $answer->question->option_b, 'C' => $answer->question->option_c, 'D' => $answer->question->option_d] as $key => $val)
                                        @php
                                            $isCorrectOption = strtoupper($key) === strtoupper($answer->question->correct_answer);
                                            $isSelectedByUser = $answer->selected_option && strtoupper($answer->selected_option) === strtoupper($key);
                                        @endphp
                                        <div style="display:flex;align-items:center;gap:10px;padding:12px 14px;border-radius:8px;
                                            border:1px solid {{ $isCorrectOption ? 'rgba(34,197,94,0.35)' : ($isSelectedByUser && !$answer->is_correct ? 'rgba(239,68,68,0.35)' : 'rgba(15,23,42,0.06)') }};
                                            background:{{ $isCorrectOption ? 'rgba(34,197,94,0.05)' : ($isSelectedByUser && !$answer->is_correct ? 'rgba(239,68,68,0.05)' : 'rgba(15,23,42,0.01)') }};">
                                            
                                            <span style="width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:800;
                                                background:{{ $isCorrectOption ? '#22c55e' : ($isSelectedByUser ? '#ef4444' : 'rgba(15,23,42,0.08)') }};
                                                color:{{ $isCorrectOption || $isSelectedByUser ? 'white' : '#475569' }}">
                                                {{ $key }}
                                            </span>
                                            
                                            <span style="font-size:0.85rem;
                                                color:{{ $isCorrectOption ? '#16a34a' : ($isSelectedByUser ? '#ef4444' : '#334155') }};
                                                font-weight:{{ $isCorrectOption || $isSelectedByUser ? '600' : 'normal' }}">
                                                {{ $val }}
                                            </span>

                                            @if($isCorrectOption)
                                                <span style="margin-left:auto;color:#16a34a;font-size:0.7rem;font-weight:800;text-transform:uppercase;letter-spacing:0.04em;">Correct Option</span>
                                            @elseif($isSelectedByUser)
                                                <span style="margin-left:auto;color:#ef4444;font-size:0.7rem;font-weight:800;text-transform:uppercase;letter-spacing:0.04em;">Selected</span>
                                            @endif

                                        </div>
                                    @endforeach
                                </div>

                                @if(!$answer->selected_option)
                                    <div style="margin-top:12px;display:inline-flex;align-items:center;gap:6px;background:rgba(245,158,11,0.08);color:#d97706;border:1px solid rgba(245,158,11,0.15);padding:4px 10px;border-radius:6px;font-size:0.75rem;font-weight:600;">
                                        ⚠️ Student skipped this question.
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <style>
        @media(min-width: 640px) {
            .sm-grid-cols-2 {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
        @media(max-width: 640px) {
            .banner-right {
                text-align: left !important;
            }
        }
    </style>
</x-app-layout>