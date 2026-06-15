@extends('layouts.app')

@section('title', $page['meta_title'] ?? $page['title'])

@section('content')
<section class="section bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <img class="img-fluid rounded mb-4 w-100" src="{{ $image }}" alt="{{ $page['alt'] ?? $page['title'] }}" style="max-height:460px; object-fit:cover;">
                <h1 class="fw-bold mb-3">{{ $page['title'] }}</h1>
                @if(! empty($page['heading_2']))
                    <h2 class="h4 mb-3">{{ $page['heading_2'] }}</h2>
                @endif
                <div class="lead">
                    {!! $page['description'] !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
