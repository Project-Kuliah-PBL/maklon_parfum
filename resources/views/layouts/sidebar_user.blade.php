<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PT Arum Jaya Gemilang') - Klien Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-bg: #3b1f6b;
            --sidebar-width: 220px;
            --accent-gold: #c9a227;
            --accent-purple: #5b21b6;
            --accent-purple-light: #7c3aed;
            --text-primary: #1e1b4b;
            --text-secondary: #6b7280;
            --bg-page: #f5f4fb;
            --bg-card: #ffffff;
            --border: #e5e7eb;
            --status-green: #16a34a;
            --status-green-bg: #dcfce7;
            --status-blue: #1d4ed8;
            --status-blue-bg: #dbeafe;
            --status-yellow: #d97706;
            --status-yellow-bg: #fef3c7;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-page);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 100;
            padding: 24px 16px;
        }

        .sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 36px;
        }



        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            border-radius: 10px;
            color: #c4b5e8;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 4px;
        }

        .nav-item:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .nav-item.active { background: #fff; color: var(--accent-purple); }
        .nav-item.active svg { color: var(--accent-purple); }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* ── TOPBAR ── */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-hamburger { cursor: pointer; color: var(--text-secondary); }
        .topbar-hamburger svg { width: 22px; height: 22px; }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-user-info {
            text-align: right;
        }

        .topbar-user-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .topbar-user-email {
            font-size: 11px;
            color: var(--text-secondary);
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--sidebar-bg);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── PAGE CONTENT ── */
        .page-content {
            padding: 32px;
            flex: 1;
        }

        .page-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--text-secondary);
            margin-top: 4px;
            margin-bottom: 28px;
        }

        /* ── STAT CARDS ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #fff;
            border: 1.5px solid #ede9fe;
            border-radius: 14px;
            padding: 24px;
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .stat-desc {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 6px;
        }

        /* ── SECTION CARDS ── */
        .section-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 24px;
            border: 1px solid var(--border);
        }

        .section-title {
            font-size: 17px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        /* ── PROJECT ITEMS ── */
        .project-item {
            border: 1.5px solid #e9e5f5;
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 16px;
            position: relative;
        }

        .project-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .project-id-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .project-id {
            font-size: 16px;
            font-weight: 700;
        }

        .badge {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-blue { background: var(--status-blue-bg); color: var(--status-blue); }
        .badge-yellow { background: var(--status-yellow-bg); color: var(--status-yellow); }
        .badge-green { background: var(--status-green-bg); color: var(--status-green); }

        .btn-detail {
            background: var(--sidebar-bg);
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.2s;
        }

        .btn-detail:hover { opacity: 0.85; }

        .project-type {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 14px;
        }

        .project-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 14px;
        }

        .meta-label { font-size: 11px; color: var(--text-secondary); }
        .meta-value { font-size: 14px; font-weight: 700; }

        .progress-wrap { margin-top: 4px; }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .progress-label { font-size: 12px; color: var(--text-secondary); }
        .progress-pct { font-size: 13px; font-weight: 700; }

        .progress-bar {
            height: 8px;
            background: #ede9fe;
            border-radius: 99px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--sidebar-bg);
            border-radius: 99px;
            transition: width 0.6s ease;
        }

        /* ── HISTORY TABLE ── */
        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th {
            text-align: left;
            font-size: 12px;
            color: var(--text-secondary);
            font-weight: 600;
            padding: 10px 14px;
            border-bottom: 1px solid var(--border);
        }

        .history-table td {
            padding: 14px 14px;
            font-size: 13.5px;
            border-bottom: 1px solid #f3f4f6;
        }

        .history-table tr:last-child td { border-bottom: none; }

        /* ALERT / FLASH */
        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success { background: var(--status-green-bg); color: var(--status-green); }
        .alert-error { background: #fee2e2; color: #b91c1c; }
    </style>
    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="PT Arum Jaya Gemilang" style="width: 100px; height: auto; object-fit: contain;">
    </div>

    <nav>
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>
        <a href="{{ route('tracking.index') }}" class="nav-item {{ request()->routeIs('tracking*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            Tracking Proses
        </a>
        <a href="{{ route('account.settings') }}" class="nav-item {{ request()->routeIs('account*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            Pengaturan Akun
        </a>
    </nav>
</aside>

{{-- MAIN --}}
<div class="main-wrapper">
    <header class="topbar">
        <span class="topbar-hamburger">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </span>
        <div class="topbar-user">
            <div class="topbar-user-info">
                <div class="topbar-user-name">{{ auth()->user()->name ?? 'Brand Parfum ABC' }}</div>
                <div class="topbar-user-email">{{ auth()->user()->email ?? 'brand@email.com' }}</div>
            </div>
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'BP', 0, 2)) }}</div>
        </div>
    </header>

    <main class="page-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>