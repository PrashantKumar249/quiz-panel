<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'QuizPanel') }} — Smart Quiz Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { font-family: 'Inter', sans-serif; }
            body { background: #f8fafc; color: #0f172a; }

            /* Scrollbar */
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: #f1f5f9; }
            ::-webkit-scrollbar-thumb { background: #6366f1; border-radius: 3px; }

            /* Glassmorphism card */
            .glass-card {
                background: rgba(255,255,255,0.75);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(15,23,42,0.06);
                border-radius: 16px;
                box-shadow: 0 4px 20px rgba(15,23,42,0.04);
            }
            .glass-card-light {
                background: rgba(255,255,255,0.85);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(15,23,42,0.08);
                border-radius: 16px;
                box-shadow: 0 4px 25px rgba(15,23,42,0.05);
            }
            /* gradient text */
            .gradient-text {
                background: linear-gradient(135deg, #4f46e5, #7c3aed);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            /* stat card glow */
            .stat-glow-blue  { box-shadow: 0 4px 20px rgba(99,102,241,0.06); border-color: rgba(99,102,241,0.2) !important; }
            .stat-glow-purple{ box-shadow: 0 4px 20px rgba(168,85,247,0.06); border-color: rgba(168,85,247,0.2) !important; }
            .stat-glow-green { box-shadow: 0 4px 20px rgba(34,197,94,0.06); border-color: rgba(34,197,94,0.2) !important; }
            .stat-glow-red   { box-shadow: 0 4px 20px rgba(239,68,68,0.06); border-color: rgba(239,68,68,0.2) !important; }
            /* Table styles */
            .dark-table thead tr { background: rgba(99,102,241,0.04); }
            .dark-table th { color: #475569; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 14px 20px; font-weight: 600; }
            .dark-table td { padding: 14px 20px; border-bottom: 1px solid rgba(15,23,42,0.05); color: #334155; vertical-align: middle; }
            .dark-table tbody tr:hover { background: rgba(99,102,241,0.02); transition: background 0.2s; }
            /* Buttons */
            .btn-primary {
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                color: white; border: none; border-radius: 10px;
                padding: 9px 20px; font-weight: 600; font-size: 0.85rem;
                cursor: pointer; transition: all 0.2s;
                box-shadow: 0 4px 15px rgba(99,102,241,0.2);
            }
            .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(99,102,241,0.35); filter: brightness(1.05); }
            .btn-secondary {
                background: rgba(15,23,42,0.04); color: #475569;
                border: 1px solid rgba(15,23,42,0.08); border-radius: 10px;
                padding: 9px 20px; font-weight: 500; font-size: 0.85rem;
                cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
            }
            .btn-secondary:hover { background: rgba(15,23,42,0.08); color: #0f172a; }
            .btn-danger {
                background: rgba(239,68,68,0.08); color: #dc2626;
                border: 1px solid rgba(239,68,68,0.15); border-radius: 10px;
                padding: 9px 20px; font-weight: 500; font-size: 0.85rem;
                cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
            }
            .btn-danger:hover { background: rgba(239,68,68,0.15); }
            .btn-success {
                background: linear-gradient(135deg, #22c55e, #16a34a);
                color: white; border: none; border-radius: 10px;
                padding: 9px 20px; font-weight: 600; font-size: 0.85rem;
                cursor: pointer; transition: all 0.2s;
                box-shadow: 0 4px 15px rgba(34,197,94,0.2);
            }
            .btn-success:hover { transform: translateY(-1px); filter: brightness(1.05); }
            /* Form inputs */
            .dark-input {
                width: 100%; background: #ffffff;
                border: 1px solid rgba(15,23,42,0.12); border-radius: 10px;
                padding: 12px 16px; color: #0f172a; font-size: 0.9rem;
                outline: none; transition: all 0.2s;
            }
            .dark-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,0.15); background: #ffffff; }
            .dark-input::placeholder { color: #94a3b8; }
            .dark-label { display: block; color: #475569; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
            /* Badge */
            .badge-blue   { background: rgba(99,102,241,0.08); color: #6366f1; border-radius: 20px; padding: 4px 12px; font-size: 0.75rem; font-weight: 600; }
            .badge-green  { background: rgba(34,197,94,0.08); color: #16a34a; border-radius: 20px; padding: 4px 12px; font-size: 0.75rem; font-weight: 600; }
            .badge-red    { background: rgba(239,68,68,0.08); color: #dc2626; border-radius: 20px; padding: 4px 12px; font-size: 0.75rem; font-weight: 600; }
            .badge-yellow { background: rgba(234,179,8,0.08); color: #b45309; border-radius: 20px; padding: 4px 12px; font-size: 0.75rem; font-weight: 600; }
            /* Alert */
            .alert-success { background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.15); color: #16a34a; padding: 14px 18px; border-radius: 12px; }
            /* Avatar */
            .avatar { background: linear-gradient(135deg, #6366f1, #a855f7); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; text-transform: uppercase; flex-shrink: 0; }
            /* Page heading */
            .page-header { border-bottom: 1px solid rgba(15,23,42,0.06); background: rgba(255,255,255,0.4); backdrop-filter: blur(20px); }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" style="background: #f8fafc;">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="page-header">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
