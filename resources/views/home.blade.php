@extends('layouts.app')
@section('title', 'ServiceLink Kenya')
@section('content')
<section class="hero section">
    <div class="container py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold">ServiceLink Kenya</h1>
                <p class="lead mb-4">Book vetted cleaners, movers, handymen, pest control, laundry, appliance repair, gardening, CCTV, Wi-Fi and office maintenance teams across Kenya.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a class="btn btn-brand btn-lg" href="{{ route('bookings.create') }}">Book a Service</a>
                    <a class="btn btn-light btn-lg" href="{{ route('register') }}">Become a Service Provider</a>
                    <a class="btn btn-outline-light btn-lg" href="https://wa.me/254711000000">Call/WhatsApp Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4"><div><h2 class="fw-bold">Popular Services</h2><p class="text-muted mb-0">Transparent starting prices in KES.</p></div></div>
        <div class="row g-3">
            @foreach($popularServices as $service)
                <div class="col-md-6 col-lg-4"><div class="card h-100"><div class="card-body"><span class="badge text-bg-success mb-2">{{ $service->category->name }}</span><h5>{{ $service->name }}</h5><p class="text-muted">{{ $service->description }}</p><strong>KES {{ number_format($service->base_price) }}</strong></div></div></div>
            @endforeach
        </div>
    </div>
</section>
<section class="section bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4"><h3>1. Choose</h3><p>Select a service, location and preferred time.</p></div>
            <div class="col-md-4"><h3>2. Match</h3><p>Dispatch assigns a verified provider for the job.</p></div>
            <div class="col-md-4"><h3>3. Pay & Review</h3><p>Pay via M-Pesa STK Push and rate the provider.</p></div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6"><h2 class="fw-bold">Why Choose Us</h2><p>Verified providers, dispatch support, same-day options, M-Pesa-ready payments, and coverage for homes and businesses.</p></div>
            <div class="col-lg-6"><div class="row g-2">@foreach($categories as $category)<div class="col-6"><div class="p-3 bg-white rounded shadow-sm">{{ $category->name }}</div></div>@endforeach</div></div>
        </div>
    </div>
</section>
<section class="section bg-white">
    <div class="container">
        <h2 class="fw-bold">Service Areas</h2>
        <p class="lead">Nairobi, Kiambu, Machakos, Kajiado, Mombasa, Nakuru, Kisumu and Eldoret.</p>
        <div class="row g-3 mt-2">
            @forelse($testimonials as $review)
                <div class="col-md-4"><div class="card h-100"><div class="card-body"><strong>{{ $review->customer->name }}</strong><p class="mb-1">{{ $review->comment }}</p><span class="text-brand">{{ str_repeat('*', $review->rating) }}</span></div></div></div>
            @empty
                <div class="col"><p class="text-muted">Customer testimonials will appear here after completed jobs are reviewed.</p></div>
            @endforelse
        </div>
    </div>
</section>
@endsection
