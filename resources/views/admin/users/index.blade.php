<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="gradient-text" style="font-size:1.4rem;font-weight:800;margin:0;">User Management</h2>
                <p style="color:#64748b;font-size:0.8rem;margin-top:2px;">Manage all registered users</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary" style="text-decoration:none;">← Dashboard</a>
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

            {{-- Stats Row --}}
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
                <div class="glass-card stat-glow-blue" style="padding:20px;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#818cf8;line-height:1;">{{ $users->count() }}</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;font-weight:500;">Total Users</p>
                </div>
                <div class="glass-card stat-glow-green" style="padding:20px;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#4ade80;line-height:1;">{{ $users->where('is_active', true)->count() }}</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;font-weight:500;">Active</p>
                </div>
                <div class="glass-card stat-glow-red" style="padding:20px;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#f87171;line-height:1;">{{ $users->where('is_active', false)->count() }}</p>
                    <p style="color:#64748b;font-size:0.8rem;margin-top:6px;font-weight:500;">Blocked</p>
                </div>
            </div>

            {{-- Users Table --}}
            <div class="glass-card" style="overflow-x:auto;width:100%;">
                <table class="dark-table" style="width:100%;border-collapse:collapse;min-width:650px;">
                    <thead>
                        <tr>
                            <th style="text-align:left;">#</th>
                            <th style="text-align:left;">Name</th>
                            <th style="text-align:left;">Email</th>
                            <th style="text-align:center;">Attempts</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Joined</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td style="color:#475569;font-size:0.8rem;width:50px;">{{ $index + 1 }}</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div class="avatar" style="width:36px;height:36px;font-size:0.85rem;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span style="color:#0f172a;font-weight:600;font-size:0.9rem;">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td style="color:#64748b;font-size:0.85rem;">{{ $user->email }}</td>
                                <td style="text-align:center;">
                                    <span class="badge-blue">{{ $user->quiz_attempts_count }} attempts</span>
                                </td>
                                <td style="text-align:center;">
                                    @if($user->is_active)
                                        <span class="badge-green">● Active</span>
                                    @else
                                        <span class="badge-red">● Blocked</span>
                                    @endif
                                </td>
                                <td style="text-align:center;color:#475569;font-size:0.8rem;">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td style="text-align:center;">
                                    <div style="display:flex;align-items:center;justify-content:center;gap:8px;">
                                        <a href="{{ route('admin.user.detail', $user->id) }}"
                                           style="background:rgba(56,189,248,0.15);color:#38bdf8;border:1px solid rgba(56,189,248,0.2);border-radius:8px;padding:6px 12px;font-size:0.75rem;font-weight:600;text-decoration:none;transition:all 0.2s;"
                                           onmouseover="this.style.background='rgba(56,189,248,0.25)'"
                                           onmouseout="this.style.background='rgba(56,189,248,0.15)'">
                                            👁 View
                                        </a>
                                        <form action="{{ route('admin.user.toggle-block', $user->id) }}" method="POST" style="margin:0;">
                                            @csrf
                                            <button type="submit"
                                                onclick="return confirm('{{ $user->is_active ? 'Block' : 'Unblock' }} this user?')"
                                                style="{{ $user->is_active
                                                    ? 'background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.2);'
                                                    : 'background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.2);' }}border-radius:8px;padding:6px 12px;font-size:0.75rem;font-weight:600;cursor:pointer;transition:all 0.2s;">
                                                {{ $user->is_active ? '🚫 Block' : '✅ Unblock' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center;padding:60px;color:#475569;">
                                    <div style="font-size:3rem;margin-bottom:12px;">👥</div>
                                    <p style="color:#64748b;font-size:1rem;">Koi user register nahi kiya abhi tak</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>