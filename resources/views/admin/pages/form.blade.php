@extends('layouts.dashboard')

@section('title', $page ? 'Update Page' : 'Create Page')
@section('dashboard-title', '')
@section('dashboard-subtitle', '')

@section('content')
<style>
    .page-form-screen, .page-form-screen button, .page-form-screen input, .page-form-screen select, .page-form-screen textarea { font-family:'Manrope', system-ui, -apple-system, "Segoe UI", sans-serif; letter-spacing:0; }
    .page-form-screen { min-height:100vh; padding:42px 24px 32px; background:#eef1f7; color:#001438; font-weight:400; }
    .page-form-wrap { max-width:1225px; }
    .page-form-title { margin:0 0 28px; font-size:2.35rem; line-height:1.1; font-weight:800; color:#001438; }
    .page-form-card { background:#fff; border-radius:5px 5px 0 0; box-shadow:0 0 0 1px rgba(15,23,42,.03), 0 10px 28px rgba(15,23,42,.04); overflow:hidden; }
    .page-form-card-head { background:#0d80f7; min-height:64px; display:flex; align-items:center; justify-content:space-between; padding:15px 30px; }
    .page-form-card-head h2 { margin:0; font-size:1.4rem; font-weight:800; color:#001438; }
    .page-form-back { color:#001438; text-decoration:none; font-size:1rem; font-weight:800; }
    .page-form-body { padding:30px 30px 36px; }
    .page-field { margin-bottom:24px; }
    .page-label { display:block; margin-bottom:11px; font-size:1.25rem; font-weight:800; color:#07101e; }
    .page-input, .page-select, .page-textarea { width:100%; border:1px solid #d9e1eb; border-radius:16px; color:#243246; background:#fff; font-size:1.16rem; font-weight:400; outline:none; }
    .page-input, .page-select { height:54px; padding:0 18px; }
    .page-select { border-radius:6px; appearance:auto; }
    .page-textarea { min-height:360px; padding:18px 19px; border-radius:10px; }
    .page-input::placeholder, .page-textarea::placeholder { color:#8794a3; font-weight:400; }
    .page-input:focus, .page-select:focus, .page-textarea:focus { border-color:#9bc9fb; box-shadow:0 0 0 3px rgba(13,128,247,.12); }
    .page-actions { display:flex; gap:12px; align-items:center; margin-top:26px; }
    .page-save { border:0; border-radius:8px; padding:11px 22px; background:#0d80f7; color:#fff; font-size:1rem; font-weight:800; }
    .page-cancel { border:1px solid #d6dee8; border-radius:8px; padding:10px 20px; background:#fff; color:#243246; font-size:1rem; font-weight:800; text-decoration:none; }
    .tox.tox-tinymce { border-radius:14px; border-color:#e5e7eb; min-height:430px; font-family:'Manrope', system-ui, -apple-system, "Segoe UI", sans-serif; }
    .tox .tox-menubar, .tox .tox-toolbar, .tox .tox-toolbar__primary, .tox .tox-tbtn, .tox .tox-mbtn, .tox .tox-statusbar { font-family:'Manrope', system-ui, -apple-system, "Segoe UI", sans-serif; }
    .invalid-feedback { display:block; font-size:1rem; }
    @media (max-width: 991.98px) {
        .page-form-screen { padding:28px 16px; }
        .page-form-title { font-size:2.15rem; }
        .page-form-body, .page-form-card-head { padding-left:20px; padding-right:20px; }
        .page-label { font-size:1.15rem; }
        .page-input, .page-select, .page-textarea { font-size:1rem; }
    }
</style>
<div class="page-form-screen">
    <div class="page-form-wrap">
        <h1 class="page-form-title">Manage Pages</h1>

        <form class="page-form-card" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($method !== 'POST')
                @method($method)
            @endif

            <div class="page-form-card-head">
                <h2>{{ $page ? 'Update Post' : 'Add New Post' }}</h2>
                <a class="page-form-back" href="{{ route('admin.pages') }}">Back</a>
            </div>

            <div class="page-form-body">
                <div class="page-field">
                    <label class="page-label" for="meta_title">Meta Title</label>
                    <input class="page-input" id="meta_title" name="meta_title" value="{{ old('meta_title', $page['meta_title'] ?? '') }}" placeholder="Enter Meta Title" maxlength="160" required>
                    @error('meta_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="page-field">
                    <label class="page-label" for="meta_description">Meta Description</label>
                    <input class="page-input" id="meta_description" name="meta_description" value="{{ old('meta_description', $page['meta_description'] ?? '') }}" placeholder="Enter Meta Description" maxlength="255">
                    @error('meta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="page-field">
                    <label class="page-label" for="title">Page Title</label>
                    <input class="page-input" id="title" name="title" value="{{ old('title', $page['title'] ?? '') }}" placeholder="Enter Keyword Title" maxlength="180" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="page-field">
                    <label class="page-label" for="alt">Image Alt Text</label>
                    <input class="page-input" id="alt" name="alt" value="{{ old('alt', $page['alt'] ?? '') }}" placeholder="Enter Image Alt Text" maxlength="160">
                    @error('alt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="page-field">
                    <label class="page-label" for="heading_2">Heading 2</label>
                    <input class="page-input" id="heading_2" name="heading_2" value="{{ old('heading_2', $page['heading_2'] ?? '') }}" placeholder="Enter Heading 2" maxlength="180">
                    @error('heading_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="page-field">
                    <label class="page-label" for="type">Type</label>
                    <select class="page-select" id="type" name="type" required>
                        @foreach(['Post', 'Page'] as $type)
                            <option value="{{ $type }}" @selected(old('type', $page['type'] ?? 'Post') === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="page-field">
                    <label class="page-label" for="image">Image</label>
                    <input class="page-input" id="image" name="image" type="file" accept="image/*">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="page-field">
                    <label class="page-label" for="description">Page Description:</label>
                    <textarea class="page-textarea" id="description" name="description">{{ old('description', $page['description'] ?? '') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="page-actions">
                    <button class="page-save" type="submit">{{ $page ? 'Update' : 'Save' }}</button>
                    <a class="page-cancel" href="{{ route('admin.pages') }}">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (!window.tinymce) {
            return;
        }

        tinymce.init({
            selector: '#description',
            menubar: 'file edit view insert format tools table',
            plugins: 'link image media table code fullscreen lists',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image media | code fullscreen',
            height: 430,
            branding: false,
            promotion: false,
            content_style: "body { font-family: 'Manrope', system-ui, -apple-system, 'Segoe UI', sans-serif; font-size: 16px; font-weight: 400; color: #243246; }"
        });
    });
</script>
@endpush
