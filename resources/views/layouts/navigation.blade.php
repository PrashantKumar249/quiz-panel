<nav x-data="{ open: false }" style="background: rgba(255,255,255,0.85); border-bottom: 1px solid rgba(15,23,42,0.06); backdrop-filter: blur(20px); position: sticky; top: 0; z-index: 50;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ Auth::user() && Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-3" style="text-decoration:none;">
                    <div style="width:36px;height:36px;background:linear-gradient(135deg,#6366f1,#a855f7);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                    </div>
                    <span style="font-weight:700;font-size:1.1rem;background:linear-gradient(135deg,#818cf8,#c084fc);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">QuizPanel</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:ms-8 gap-1">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               style="padding:6px 14px;border-radius:8px;font-size:0.85rem;font-weight:600;transition:all 0.2s;text-decoration:none;
                                      {{ request()->routeIs('admin.dashboard') ? 'background:rgba(99,102,241,0.08);color:#4f46e5;' : 'color:#475569;' }}"
                               onmouseover="if(!this.style.background.includes('0.08'))this.style.background='rgba(15,23,42,0.04)';this.style.color='#0f172a'"
                               onmouseout="if(!{{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }})this.style.background='transparent';this.style.color='{{ request()->routeIs('admin.dashboard') ? '#4f46e5' : '#475569' }}'">
                                🛡️ Dashboard
                            </a>
                            <a href="{{ route('admin.quiz.list') }}"
                               style="padding:6px 14px;border-radius:8px;font-size:0.85rem;font-weight:600;transition:all 0.2s;text-decoration:none;
                                      {{ request()->routeIs('admin.quiz.*') ? 'background:rgba(99,102,241,0.08);color:#4f46e5;' : 'color:#475569;' }}"
                               onmouseover="if(!this.style.background.includes('0.08'))this.style.background='rgba(15,23,42,0.04)';this.style.color='#0f172a'"
                               onmouseout="if(!{{ request()->routeIs('admin.quiz.*') ? 'true' : 'false' }})this.style.background='transparent';this.style.color='{{ request()->routeIs('admin.quiz.*') ? '#4f46e5' : '#475569' }}'">
                                📚 Quizzes
                            </a>
                            <a href="{{ route('admin.users') }}"
                               style="padding:6px 14px;border-radius:8px;font-size:0.85rem;font-weight:600;transition:all 0.2s;text-decoration:none;
                                      {{ request()->routeIs('admin.users*') ? 'background:rgba(99,102,241,0.08);color:#4f46e5;' : 'color:#475569;' }}"
                               onmouseover="if(!this.style.background.includes('0.08'))this.style.background='rgba(15,23,42,0.04)';this.style.color='#0f172a'"
                               onmouseout="if(!{{ request()->routeIs('admin.users*') ? 'true' : 'false' }})this.style.background='transparent';this.style.color='{{ request()->routeIs('admin.users*') ? '#4f46e5' : '#475569' }}'">
                                👥 Users
                            </a>
                            <a href="{{ route('admin.results') }}"
                               style="padding:6px 14px;border-radius:8px;font-size:0.85rem;font-weight:600;transition:all 0.2s;text-decoration:none;
                                      {{ request()->routeIs('admin.results*') ? 'background:rgba(99,102,241,0.08);color:#4f46e5;' : 'color:#475569;' }}"
                               onmouseover="if(!this.style.background.includes('0.08'))this.style.background='rgba(15,23,42,0.04)';this.style.color='#0f172a'"
                               onmouseout="if(!{{ request()->routeIs('admin.results*') ? 'true' : 'false' }})this.style.background='transparent';this.style.color='{{ request()->routeIs('admin.results*') ? '#4f46e5' : '#475569' }}'">
                                📊 Results
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}"
                               style="padding:6px 14px;border-radius:8px;font-size:0.85rem;font-weight:600;transition:all 0.2s;text-decoration:none;
                                      {{ request()->routeIs('dashboard') ? 'background:rgba(99,102,241,0.08);color:#4f46e5;' : 'color:#475569;' }}"
                               onmouseover="if(!this.style.background.includes('0.08'))this.style.background='rgba(15,23,42,0.04)';this.style.color='#0f172a'"
                               onmouseout="if(!{{ request()->routeIs('dashboard') ? 'true' : 'false' }})this.style.background='transparent';this.style.color='{{ request()->routeIs('dashboard') ? '#4f46e5' : '#475569' }}'">
                                🎯 Quizzes
                            </a>
                            <a href="{{ route('user.history') }}"
                               style="padding:6px 14px;border-radius:8px;font-size:0.85rem;font-weight:600;transition:all 0.2s;text-decoration:none;
                                      {{ request()->routeIs('user.history') ? 'background:rgba(99,102,241,0.08);color:#4f46e5;' : 'color:#475569;' }}"
                               onmouseover="if(!this.style.background.includes('0.08'))this.style.background='rgba(15,23,42,0.04)';this.style.color='#0f172a'"
                               onmouseout="if(!{{ request()->routeIs('user.history') ? 'true' : 'false' }})this.style.background='transparent';this.style.color='{{ request()->routeIs('user.history') ? '#4f46e5' : '#475569' }}'">
                                📋 My History
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side: User -->
            <div class="hidden sm:flex sm:items-center sm:gap-3">
                @auth
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:34px;height:34px;background:linear-gradient(135deg,#6366f1,#a855f7);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.8rem;color:white;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p style="color:#0f172a;font-size:0.85rem;font-weight:600;line-height:1.2;">{{ Auth::user()->name }}</p>
                            <p style="color:#64748b;font-size:0.7rem;">{{ Auth::user()->isAdmin() ? '👑 Admin' : '🎓 Student' }}</p>
                        </div>
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:7px 12px;color:#94a3b8;font-size:0.8rem;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.07)'">
                                Settings
                                <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" style="padding:8px;border-radius:8px;color:#94a3b8;background:transparent;border:none;cursor:pointer;">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="border-top:1px solid rgba(255,255,255,0.06);background:rgba(15,15,26,0.98);">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" style="display:block;padding:10px 14px;color:#94a3b8;border-radius:8px;font-size:0.9rem;">🛡️ Dashboard</a>
                    <a href="{{ route('admin.quiz.list') }}" style="display:block;padding:10px 14px;color:#94a3b8;border-radius:8px;font-size:0.9rem;">📚 Quizzes</a>
                    <a href="{{ route('admin.users') }}" style="display:block;padding:10px 14px;color:#94a3b8;border-radius:8px;font-size:0.9rem;">👥 Users</a>
                    <a href="{{ route('admin.results') }}" style="display:block;padding:10px 14px;color:#94a3b8;border-radius:8px;font-size:0.9rem;">📊 Results</a>
                @else
                    <a href="{{ route('dashboard') }}" style="display:block;padding:10px 14px;color:#94a3b8;border-radius:8px;font-size:0.9rem;">🎯 Quizzes</a>
                    <a href="{{ route('user.history') }}" style="display:block;padding:10px 14px;color:#94a3b8;border-radius:8px;font-size:0.9rem;">📋 My History</a>
                @endif
            @endauth
        </div>

        <div class="pt-4 pb-3 border-t" style="border-color:rgba(255,255,255,0.06);padding:16px;">
            @auth
                <div style="color:#94a3b8;font-size:0.85rem;margin-bottom:12px;">
                    <p style="color:#e2e8f0;font-weight:600;">{{ Auth::user()->name }}</p>
                    <p>{{ Auth::user()->email }}</p>
                </div>
                <a href="{{ route('profile.edit') }}" style="display:block;padding:8px 0;color:#818cf8;font-size:0.85rem;">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="padding:8px 0;color:#f87171;font-size:0.85rem;background:none;border:none;cursor:pointer;">Log Out</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
