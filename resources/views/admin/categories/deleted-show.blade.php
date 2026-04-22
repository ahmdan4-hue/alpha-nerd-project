@extends('admin.layouts.adminlte')

@section('title','View Deleted Category')
@section('heading','View Deleted Category')

@section('content')

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">{{ $category->name }}</h3>
      <a href="{{ route('admin.categories.deleted') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>
  </div>

  <div class="card-body">
    <p><strong>ID:</strong> {{ $category->id }}</p>
    <p><strong>Deleted At:</strong> {{ $category->deleted_at }}</p>

    <div class="mt-4 d-flex gap-2 flex-wrap">
      <form method="POST" action="{{ route('admin.categories.restore', $category->id) }}">
        @csrf
        <button class="btn btn-success" type="submit">Restore</button>
      </form>

      <form method="POST" action="{{ route('admin.categories.forceDelete', $category->id) }}" onsubmit="return confirm('Delete permanently?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Hard Delete</button>
      </form>
    </div>
  </div>
</div>

@endsection
