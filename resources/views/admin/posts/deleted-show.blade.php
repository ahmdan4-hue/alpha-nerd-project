@extends('admin.layouts.adminlte')

@section('title','View Deleted Post')
@section('heading','View Deleted Post')

@section('content')

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">{{ $post->title }}</h3>
      <a href="{{ route('admin.posts.deleted') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>
  </div>

  <div class="card-body">
    <p><strong>Category ID:</strong> {{ $post->category_id }}</p>
    <p><strong>Deleted At:</strong> {{ $post->deleted_at }}</p>

    @if($post->image)
      <div class="mb-3">
        <img
          src="{{ asset($post->image) }}"
          alt="{{ $post->title }}"
          style="max-width:300px; width:100%; border-radius:12px; border:1px solid rgba(0,0,0,.12);"
        >
      </div>
    @endif

    <div class="mb-4">
      {!! nl2br(e($post->content)) !!}
    </div>

    <div class="d-flex gap-2 flex-wrap">
      <form method="POST" action="{{ route('admin.posts.restore', $post->id) }}">
        @csrf
        <button class="btn btn-success" type="submit">Restore</button>
      </form>

      <form method="POST" action="{{ route('admin.posts.forceDelete', $post->id) }}" onsubmit="return confirm('Delete permanently?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Hard Delete</button>
      </form>
    </div>
  </div>
</div>

@endsection
