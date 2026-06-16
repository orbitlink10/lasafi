<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @endif
    <title>@yield('title', 'Lasafi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --slk-green:#0f9f6e; --slk-blue:#0b5ed7; --slk-ink:#123; --slk-soft:#eef8f4; }
        body { background:#f6f9fb; color:var(--slk-ink); font-size:1rem; }
        .navbar { box-shadow:0 8px 30px rgba(16,24,40,.08); }
        .navbar .nav-link { color:#334155; font-size:1rem; font-weight:600; }
        .navbar .nav-link:hover,
        .navbar .nav-link.active { color:var(--slk-green); }
        .brand-mark { width:34px; height:34px; border-radius:8px; background:linear-gradient(135deg,var(--slk-green),var(--slk-blue)); display:inline-grid; place-items:center; color:#fff; font-weight:800; }
        .btn-brand { background:var(--slk-green); color:#fff; border:0; }
        .btn-brand:hover { background:#0a8a5f; color:#fff; }
        .text-brand { color:var(--slk-green); }
        .hero { background:linear-gradient(120deg,rgba(8,91,66,.92),rgba(9,75,151,.88)), var(--hero-image) center/cover; color:#fff; }
        .hero h1 { font-size:clamp(2.35rem, 4vw, 3.75rem); }
        .hero-video { background:rgba(255,255,255,.14); border:1px solid rgba(255,255,255,.28); border-radius:14px; padding:10px; backdrop-filter:blur(4px); }
        .lead { font-size:1.16rem; }
        .section { padding:54px 0; }
        h2 { font-size:1.8rem; }
        h3 { font-size:1.3rem; }
        h5 { font-size:1.12rem; }
        .btn-lg { --bs-btn-font-size:1.08rem; --bs-btn-padding-y:.68rem; --bs-btn-padding-x:1.08rem; }
        .card { border:0; border-radius:8px; box-shadow:0 12px 35px rgba(16,24,40,.08); }
        .services-kingdom { background:#fff; position:relative; overflow:hidden; }
        .services-kingdom .section-title { color:#172342; font-size:clamp(1.7rem,3vw,2.6rem); font-weight:850; letter-spacing:0; text-align:center; margin-bottom:32px; }
        .kingdom-service-card { min-height:285px; border:2px solid #e8ebf0; border-radius:22px; box-shadow:none; background:#fff; padding:26px 26px; display:flex; flex-direction:column; justify-content:flex-start; transition:transform .2s ease, box-shadow .2s ease; }
        .kingdom-service-card:hover { transform:translateY(-4px); box-shadow:0 18px 45px rgba(17,24,39,.08); }
        .kingdom-check { width:56px; height:56px; border-radius:50%; background:#f4b400; color:#fff; display:grid; place-items:center; font-size:1.9rem; font-weight:900; margin-bottom:28px; line-height:1; }
        .kingdom-service-card h5 { color:#172342; font-size:1.32rem; line-height:1.25; font-weight:850; margin-bottom:18px; }
        .kingdom-service-card p { color:#111827; font-size:1rem; line-height:1.42; margin-bottom:20px; }
        .kingdom-price { color:#172342; font-size:1.02rem; font-weight:850; margin-top:auto; }
        .kingdom-arrow { position:absolute; top:50%; transform:translateY(-10%); width:44px; height:44px; border:3px solid #172342; border-radius:50%; display:grid; place-items:center; color:#172342; background:#fff; font-size:2rem; line-height:1; text-decoration:none; }
        .kingdom-arrow.left { left:20px; }
        .kingdom-arrow.right { right:20px; }
        @media (max-width: 1199.98px) { .kingdom-arrow { display:none; } .kingdom-service-card { min-height:275px; } }
        .metric { border-left:4px solid var(--slk-green); }
        .status { text-transform:capitalize; }
        footer { background:#071b2f; color:#d9e8f3; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}"><span class="brand-mark">LA</span> Lasafi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#how-it-works">How It Works</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#why-lasafi">Why Lasafi</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#service-areas">Areas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#testimonials">Testimonials</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('bookings.create') }}">Book</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    @if(auth()->user()->isRole(['admin', 'dispatcher']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manage</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.services.index') }}">Services</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.providers.index') }}">Providers</a></li>
                                <li><a class="dropdown-item" href="{{ route('bookings.index') }}">Bookings</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.reports.index') }}">Reports</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                    <li class="nav-item">
                        <form method="post" action="{{ route('logout') }}">@csrf<button class="btn btn-sm btn-outline-secondary">Logout</button></form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-sm btn-brand" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<main>
    @if(session('success'))<div class="container mt-3"><div class="alert alert-success">{{ session('success') }}</div></div>@endif
    @if($errors->any())<div class="container mt-3"><div class="alert alert-danger">{{ $errors->first() }}</div></div>@endif
    @yield('content')
</main>
<footer class="py-4 mt-5">
    <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
        <span>Lasafi</span>
        <span>Cleaning, movers, repairs, networking, CCTV and office maintenance.</span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
