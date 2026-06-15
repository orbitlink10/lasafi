<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Lasafi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
        body, button, input, select, textarea { font-family:'Manrope', system-ui, -apple-system, "Segoe UI", sans-serif; letter-spacing:0; }
        body { margin:0; background:var(--dash-bg); color:var(--dash-ink); font-size:.96rem; font-weight:400; }
        .dashboard-shell { min-height:100vh; display:grid; grid-template-columns:300px minmax(0,1fr); }
        .dashboard-sidebar { background:linear-gradient(180deg,#fbfdff 0%,#eef3f8 100%); border-right:1px solid #dbe4f0; padding:30px 20px 24px; height:100vh; overflow-y:auto; position:sticky; top:0; box-shadow:8px 0 28px rgba(15,23,42,.08); }
        .dashboard-brand { display:flex; align-items:center; justify-content:center; gap:8px; background:#fff; border:1px solid #d7e1ee; border-radius:20px; padding:16px 18px; min-height:70px; font-size:1.5rem; font-weight:700; color:#303740; text-decoration:none; box-shadow:0 16px 34px rgba(15,23,42,.07); }
        .dashboard-brand-mark { display:none; }
        .sidebar-section { margin-top:34px; }
        .sidebar-heading { color:#94a4b9; font-size:.86rem; font-weight:500; letter-spacing:.22em; text-transform:uppercase; margin:0 0 18px 2px; }
        .sidebar-link { display:grid; grid-template-columns:44px 1fr; align-items:center; gap:13px; min-height:56px; padding:6px 10px; color:#42516a; text-decoration:none; font-size:1.15rem; font-weight:700; border-radius:14px; margin-bottom:10px; }
        .sidebar-link:hover, .sidebar-link.active { background:#fff; color:#213a59; box-shadow:0 14px 35px rgba(15,23,42,.06); }
        .sidebar-icon { width:44px; height:44px; border-radius:12px; background:#dfe7f2; display:grid; place-items:center; color:#647891; font-size:1.08rem; }
        .sidebar-link.active .sidebar-icon { background:#d7e2f0; color:#42658f; }
        .dashboard-main { min-width:0; padding:0; background:#eef1f7; }
        .dashboard-topbar { display:flex; justify-content:space-between; align-items:center; gap:14px; margin-bottom:18px; }
        .dashboard-title { margin:0; font-size:1.55rem; font-weight:800; color:#203a58; }
        .dashboard-subtitle { color:#6b7f99; margin:3px 0 0; font-size:.98rem; }
        .dashboard-content-card, .card { border:0; border-radius:16px; box-shadow:0 16px 45px rgba(15,23,42,.08); }
        .metric { border-left:0; }
        .metric .card-body { min-height:78px; display:flex; flex-direction:column; justify-content:center; }
        .card-body, .form-control, .form-select, .btn, .table, .form-label { font-size:1rem; }
        .h4 { font-size:1.25rem; }
        .h5 { font-size:1.12rem; }
        .h6 { font-size:1rem; }
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
                <a class="sidebar-link {{ request()->routeIs('admin.pages*') ? 'active' : '' }}" href="{{ route('admin.pages') }}">
                    <span class="sidebar-icon"><i class="bi bi-file-earmark-richtext"></i></span>
                    <span>Pages</span>
                </a>
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
        @unless(trim($__env->yieldContent('dashboard-title', 'Dashboard')) === '' && trim($__env->yieldContent('dashboard-subtitle', 'Manage Lasafi operations from one place.')) === '' && trim($__env->yieldContent('dashboard-actions')) === '')
            <div class="dashboard-topbar">
                <div>
                    @hasSection('dashboard-title')
                        @if(trim($__env->yieldContent('dashboard-title')) !== '')<h1 class="dashboard-title">@yield('dashboard-title')</h1>@endif
                    @else
                        <h1 class="dashboard-title">Dashboard</h1>
                    @endif
                    @hasSection('dashboard-subtitle')
                        @if(trim($__env->yieldContent('dashboard-subtitle')) !== '')<p class="dashboard-subtitle">@yield('dashboard-subtitle')</p>@endif
                    @else
                        <p class="dashboard-subtitle">Manage Lasafi operations from one place.</p>
                    @endif
                </div>
                @yield('dashboard-actions')
            </div>
        @endunless
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        @yield('content')
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
