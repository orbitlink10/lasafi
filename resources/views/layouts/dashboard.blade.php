<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Lasafi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --dash-bg:#eef3f9;
            --dash-panel:#f6f9fd;
            --dash-card:#ffffff;
            --dash-ink:#28405f;
            --dash-muted:#8ba0bc;
            --dash-icon:#dfe7f2;
            --dash-green:#0f9f6e;
            --dash-blue:#0b5ed7;
        }
        body { margin:0; background:var(--dash-bg); color:var(--dash-ink); font-family:system-ui,-apple-system,"Segoe UI",sans-serif; font-size:.82rem; }
        .dashboard-shell { min-height:100vh; display:grid; grid-template-columns:230px minmax(0,1fr); }
        .dashboard-sidebar { background:linear-gradient(180deg,#f8fbff 0%,#e8eef7 100%); border-right:1px solid #dbe4f0; padding:14px 10px; height:100vh; overflow-y:auto; position:sticky; top:0; }
        .dashboard-brand { display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #d7e1ee; border-radius:12px; padding:11px 12px; font-size:.9rem; font-weight:800; color:#233b5a; text-decoration:none; box-shadow:0 10px 28px rgba(15,23,42,.05); }
        .dashboard-brand-mark { width:30px; height:30px; border-radius:9px; display:grid; place-items:center; color:#fff; background:linear-gradient(135deg,var(--dash-green),var(--dash-blue)); font-size:.76rem; font-weight:800; }
        .sidebar-section { margin-top:18px; }
        .sidebar-heading { color:var(--dash-muted); font-size:.58rem; font-weight:800; letter-spacing:.18em; text-transform:uppercase; margin:0 0 8px 4px; }
        .sidebar-link { display:grid; grid-template-columns:38px 1fr; align-items:center; gap:10px; min-height:48px; padding:5px 7px; color:#2d4a70; text-decoration:none; font-size:.78rem; font-weight:700; border-radius:12px; margin-bottom:5px; }
        .sidebar-link:hover, .sidebar-link.active { background:#fff; color:#213a59; box-shadow:0 14px 35px rgba(15,23,42,.06); }
        .sidebar-icon { width:34px; height:34px; border-radius:10px; background:var(--dash-icon); display:grid; place-items:center; color:#5e789d; font-size:.95rem; }
        .sidebar-link.active .sidebar-icon { background:#d7e2f0; color:#42658f; }
        .dashboard-main { min-width:0; padding:20px; }
        .dashboard-topbar { display:flex; justify-content:space-between; align-items:center; gap:14px; margin-bottom:18px; }
        .dashboard-title { margin:0; font-size:1.18rem; font-weight:800; color:#203a58; }
        .dashboard-subtitle { color:#6b7f99; margin:3px 0 0; font-size:.78rem; }
        .dashboard-content-card, .card { border:0; border-radius:16px; box-shadow:0 16px 45px rgba(15,23,42,.08); }
        .metric { border-left:0; }
        .metric .card-body { min-height:78px; display:flex; flex-direction:column; justify-content:center; }
        .card-body, .form-control, .form-select, .btn, .table, .form-label { font-size:.8rem; }
        .h4 { font-size:1.05rem; }
        .h5 { font-size:.95rem; }
        .h6 { font-size:.78rem; }
        .btn-brand { background:var(--dash-green); color:#fff; border:0; }
        .btn-brand:hover { background:#0a8a5f; color:#fff; }
        .status { text-transform:capitalize; }
        @media (max-width: 991.98px) {
            .dashboard-shell { display:block; }
            .dashboard-sidebar { position:relative; width:100%; height:auto; max-height:none; }
            .dashboard-main { padding:16px; }
            .sidebar-link { min-height:48px; grid-template-columns:38px 1fr; }
            .sidebar-icon { width:34px; height:34px; }
        }
    </style>
</head>
<body>
@php($user = auth()->user())
<div class="dashboard-shell">
    <aside class="dashboard-sidebar">
        <a class="dashboard-brand" href="{{ route('dashboard') }}">
            <span class="dashboard-brand-mark">LA</span>
            <span>Lasafi</span>
        </a>

        <div class="sidebar-section">
            <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <span class="sidebar-icon"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
            </a>
            @if($user?->isRole(['admin', 'dispatcher']))
                <a class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                    <span class="sidebar-icon"><i class="bi bi-graph-up"></i></span>
                    <span>Analytics</span>
                </a>
            @endif
        </div>

        <div class="sidebar-section">
            <p class="sidebar-heading">Content Management</p>
            @if($user?->isRole(['admin', 'dispatcher']))
                <a class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                    <span class="sidebar-icon"><i class="bi bi-tools"></i></span>
                    <span>Services</span>
                </a>
                <a class="sidebar-link" href="{{ route('home') }}#services">
                    <span class="sidebar-icon"><i class="bi bi-grid-3x3-gap"></i></span>
                    <span>Categories</span>
                </a>
                <a class="sidebar-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">
                    <span class="sidebar-icon"><i class="bi bi-cart3"></i></span>
                    <span>Bookings</span>
                </a>
                <a class="sidebar-link {{ request()->routeIs('admin.providers.*') ? 'active' : '' }}" href="{{ route('admin.providers.index') }}">
                    <span class="sidebar-icon"><i class="bi bi-people-fill"></i></span>
                    <span>Providers</span>
                </a>
            @elseif($user?->isRole('provider'))
                <a class="sidebar-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">
                    <span class="sidebar-icon"><i class="bi bi-briefcase"></i></span>
                    <span>Jobs</span>
                </a>
            @else
                <a class="sidebar-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">
                    <span class="sidebar-icon"><i class="bi bi-cart3"></i></span>
                    <span>My Bookings</span>
                </a>
                <a class="sidebar-link" href="{{ route('bookings.create') }}">
                    <span class="sidebar-icon"><i class="bi bi-plus-square"></i></span>
                    <span>Book Service</span>
                </a>
            @endif
        </div>

        <div class="sidebar-section">
            <p class="sidebar-heading">Admin Panel</p>
            @if($user?->isRole(['admin', 'dispatcher']))
                <a class="sidebar-link" href="{{ route('admin.providers.index') }}">
                    <span class="sidebar-icon"><i class="bi bi-person-gear"></i></span>
                    <span>Users</span>
                </a>
                <a class="sidebar-link {{ request()->routeIs('admin.homepage.*') ? 'active' : '' }}" href="{{ route('admin.homepage.edit') }}">
                    <span class="sidebar-icon"><i class="bi bi-file-earmark-text"></i></span>
                    <span>Homepage Content</span>
                </a>
                <a class="sidebar-link" href="{{ route('home') }}#testimonials">
                    <span class="sidebar-icon"><i class="bi bi-chat-square-text-fill"></i></span>
                    <span>Testimonials</span>
                </a>
            @endif
            <a class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                <span class="sidebar-icon"><i class="bi bi-person-circle"></i></span>
                <span>Profile</span>
            </a>
            <a class="sidebar-link" href="{{ route('home') }}">
                <span class="sidebar-icon"><i class="bi bi-house-door"></i></span>
                <span>Website</span>
            </a>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="sidebar-link w-100 border-0 text-start" type="submit">
                    <span class="sidebar-icon"><i class="bi bi-box-arrow-right"></i></span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="dashboard-main">
        <div class="dashboard-topbar">
            <div>
                <h1 class="dashboard-title">@yield('dashboard-title', 'Dashboard')</h1>
                <p class="dashboard-subtitle">@yield('dashboard-subtitle', 'Manage Lasafi operations from one place.')</p>
            </div>
            @yield('dashboard-actions')
        </div>
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        @yield('content')
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
