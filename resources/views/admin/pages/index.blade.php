@extends('layouts.dashboard')

@section('title', 'Pages')
@section('dashboard-title', '')
@section('dashboard-subtitle', '')

@section('content')
@php
    $imageUrl = function (?string $image) {
        if (! $image) {
            return 'https://via.placeholder.com/260x150?text=No+Image';
        }

        return str_starts_with($image, 'http') ? $image : asset('storage/'.ltrim($image, '/'));
    };
@endphp
<style>
    .pages-screen, .pages-screen button, .pages-screen input, .pages-screen select { font-family:'Manrope', system-ui, -apple-system, "Segoe UI", sans-serif; letter-spacing:0; }
    .pages-screen { min-height:100vh; padding:56px 30px 36px 38px; background:#eef1f7; color:#001a3d; font-weight:400; }
    .pages-heading h1 { margin:0; font-size:2.75rem; line-height:1.1; font-weight:800; letter-spacing:0; color:#001438; }
    .pages-heading p { margin:10px 0 35px; font-size:1.48rem; font-weight:400; color:#667789; }
    .pages-card { background:#fff; border-radius:8px 8px 0 0; overflow:hidden; box-shadow:none; }
    .pages-card-head { display:flex; align-items:center; justify-content:space-between; min-height:82px; padding:18px 30px; border-bottom:1px solid #dce5ef; }
    .pages-card-title { margin:0; font-size:1.55rem; font-weight:800; color:#001438; }
    .pages-add-btn { display:inline-flex; align-items:center; gap:8px; border:0; border-radius:26px; padding:10px 21px; color:#087df4; background:#f7f9fb; font-size:1.25rem; font-weight:800; text-decoration:none; }
    .pages-toolbar { display:flex; align-items:center; gap:10px; padding:30px 30px 24px; background:#fff; }
    .pages-select { width:152px; height:47px; border:1px solid #cdd6e2; border-radius:6px; padding:0 14px; font-size:1rem; font-weight:400; color:#2d3748; background:#fff; }
    .pages-apply { height:47px; border:0; border-radius:24px; padding:0 20px; background:#0d80f7; color:#fff; font-size:1.2rem; font-weight:700; }
    .pages-table-wrap { padding:0 30px 28px; background:#fff; overflow-x:auto; }
    .pages-table { min-width:1060px; width:100%; border-collapse:collapse; table-layout:fixed; color:#001438; }
    .pages-table thead tr { background:#f7f9fb; border-top:1px solid #dce5ef; border-bottom:1px solid #dce5ef; }
    .pages-table th { padding:18px 18px; color:#556e8f; font-size:1.02rem; letter-spacing:.24em; text-transform:uppercase; font-weight:800; }
    .pages-table td { padding:18px; font-size:1.42rem; font-weight:400; vertical-align:middle; border-bottom:24px solid #fff; background:#f0f0f0; }
    .pages-table tbody tr:nth-child(even) td { background:#fff; }
    .pages-check { width:20px; height:20px; border:1px solid #7b8794; border-radius:4px; }
    .pages-no { width:88px; color:#002d68; }
    .pages-image { width:225px; height:149px; object-fit:cover; display:block; }
    .pages-action { display:flex; flex-direction:column; align-items:flex-start; gap:4px; }
    .pages-pill { min-width:132px; height:44px; display:inline-flex; align-items:center; justify-content:center; gap:7px; border-radius:22px; background:#fff; font-size:1.18rem; line-height:1; font-weight:500; text-decoration:none; }
    .pages-pill.preview { color:#0798bd; border:1px solid #08a7ce; }
    .pages-pill.update { color:#ffb000; border:1px solid #ffbf19; }
    .pages-pill.delete { color:#ff2434; border:1px solid #ff2434; }
    .pages-delete-form { margin:0; }
    @media (max-width: 991.98px) {
        .pages-screen { padding:28px 16px; }
        .pages-heading h1 { font-size:2.15rem; }
        .pages-heading p { font-size:1.1rem; }
        .pages-card-head, .pages-toolbar, .pages-table-wrap { padding-left:16px; padding-right:16px; }
    }
</style>
<div class="pages-screen">
    <div class="pages-heading">
        <h1>Pages</h1>
        <p>Manage site pages and published content.</p>
    </div>

    <section class="pages-card">
        <div class="pages-card-head">
            <h2 class="pages-card-title">Post List</h2>
            <a class="pages-add-btn" href="{{ route('admin.pages.create') }}"><i class="bi bi-plus-lg"></i> Add Page</a>
        </div>

        <div class="pages-toolbar">
            <select class="pages-select" aria-label="Bulk actions">
                <option>Bulk actions</option>
                <option>Delete</option>
                <option>Publish</option>
            </select>
            <button class="pages-apply" type="button">Apply</button>
        </div>

        <div class="pages-table-wrap">
            <table class="pages-table">
                <thead>
                    <tr>
                        <th style="width:60px;"><input class="pages-check" type="checkbox"></th>
                        <th style="width:90px;">No.</th>
                        <th style="width:260px;">Image</th>
                        <th>Title</th>
                        <th>Alt Text</th>
                        <th style="width:160px;">Type</th>
                        <th style="width:200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td><input class="pages-check" type="checkbox" name="selected[]" value="{{ $post['id'] }}"></td>
                            <td class="pages-no">{{ $post['id'] }}</td>
                            <td><img class="pages-image" src="{{ $imageUrl($post['image'] ?? null) }}" alt="{{ $post['alt'] ?? $post['title'] }}"></td>
                            <td>{{ $post['title'] }}</td>
                            <td>{{ $post['alt'] ?? $post['title'] }}</td>
                            <td>{{ $post['type'] ?? 'Post' }}</td>
                            <td>
                                <div class="pages-action">
                                    <a class="pages-pill preview" href="{{ route('pages.preview', $post['slug']) }}" target="_blank"><i class="bi bi-eye-fill"></i> Preview</a>
                                    <a class="pages-pill update" href="{{ route('admin.pages.edit', $post['id']) }}"><i class="bi bi-pencil-square"></i> Update</a>
                                    <form class="pages-delete-form" method="post" action="{{ route('admin.pages.destroy', $post['id']) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="pages-pill delete" type="submit" onclick="return confirm('Delete this page?')"><i class="bi bi-trash3-fill"></i> Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
