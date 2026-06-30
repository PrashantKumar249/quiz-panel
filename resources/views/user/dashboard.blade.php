<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h2 class="gradient-text" style="font-size:1.6rem;font-weight:800;margin:0;">Available Quizzes</h2>
                <p style="color:#64748b;font-size:0.85rem;margin-top:2px;">Test your knowledge and practice your skills</p>
            </div>
            <a href="{{ route('user.history') }}" class="btn-secondary" style="text-decoration:none;">
                📋 My Test History
            </a>
        </div>
    </x-slot>

    <div style="padding:32px 0;">
        <div class="max-w-7xl mx-auto" style="padding:0 24px;">

            {{-- WELCOME MESSAGE CARD --}}
            <div class="glass-card" style="padding:28px;margin-bottom:32px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;border-left:4px solid #6366f1;">
                <div>
                    <h3 style="color:#0f172a;font-weight:700;font-size:1.15rem;margin:0;">Welcome back, {{ Auth::user()->name }}! 🎓</h3>
                    <p style="color:#475569;font-size:0.85rem;margin-top:4px;margin-bottom:0;">Ready to challenge yourself? Select any of the quizzes below to begin.</p>
                </div>
                <div style="display:flex;gap:12px;">
                    <a href="{{ route('user.history') }}" class="btn-primary" style="text-decoration:none;background:linear-gradient(135deg,#6366f1,#8b5cf6);">
                        📋 View History
                    </a>
                </div>
            </div>

            {{-- QUIZ CARDS GRID --}}
            @if($quizzes->isEmpty())
                <div class="glass-card" style="padding:60px;text-align:center;color:#475569;">
                    <div style="font-size:3.5rem;margin-bottom:16px;">😕</div>
                    <p style="font-size:1.1rem;color:#0f172a;margin-bottom:8px;font-weight:600;">No Quizzes Available</p>
                    <p style="font-size:0.85rem;color:#64748b;margin:0;">Abhi koi active quiz nahi hai. Please thodi der baad check karein.</p>
                </div>
            @else
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px;">
                    @foreach($quizzes as $quiz)
                        <div class="glass-card" style="overflow:hidden;display:flex;flex-direction:column;transition:all 0.25s;height:100%;" 
                             onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(99,102,241,0.08)';this.style.borderColor='rgba(99,102,241,0.2)';" 
                             onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(15,23,42,0.04)';this.style.borderColor='rgba(15,23,42,0.06)';">
                            
                            {{-- Card Header --}}
                            <div style="background:linear-gradient(135deg,rgba(99,102,241,0.04),rgba(168,85,247,0.04));padding:20px;border-bottom:1px solid rgba(15,23,42,0.05);position:relative;">
                                <div style="position:absolute;top:0;right:0;width:80px;height:80px;background:rgba(99,102,241,0.02);border-radius:50%;filter:blur(20px);"></div>
                                <h3 style="color:#0f172a;font-weight:800;font-size:1.1rem;margin:0;line-height:1.4;">{{ $quiz->title }}</h3>
                            </div>

                            {{-- Card Body --}}
                            <div style="padding:20px;display:flex;flex-direction:column;flex-grow:1;justify-content:space-between;gap:20px;">
                                <div>
                                    @if($quiz->description)
                                        <p style="color:#475569;font-size:0.85rem;line-height:1.6;margin:0;">{{ Str::limit($quiz->description, 110) }}</p>
                                    @else
                                        <p style="color:#94a3b8;font-size:0.85rem;font-style:italic;margin:0;">No details or instructions provided for this quiz.</p>
                                    @endif
                                </div>

                                <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;border-top:1px solid rgba(15,23,42,0.04);padding-top:16px;">
                                    <span class="badge-blue" style="font-size:0.75rem;display:inline-flex;align-items:center;gap:6px;padding:5px 12px;">
                                        <span>❓</span> <strong>{{ $quiz->questions_count }} Questions</strong>
                                    </span>
                                    <span class="badge-yellow" style="font-size:0.75rem;display:inline-flex;align-items:center;gap:6px;padding:5px 12px;">
                                        <span>⏱️</span> <strong>{{ $quiz->time_limit }} Mins</strong>
                                    </span>
                                </div>

                                {{-- Start Button --}}
                                <form action="{{ route('user.quiz.start', $quiz->id) }}" method="POST" style="margin:0;width:100%;">
                                    @csrf
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to start this quiz? The timer will start immediately!')"
                                        class="btn-primary" style="width:100%;justify-content:center;padding:11px;font-size:0.9rem;font-weight:700;">
                                        🚀 Start Test
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>