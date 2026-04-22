@extends('admin.layouts.adminlte')

@section('title','Edit Category')
@section('heading','Edit Category')

@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
    <strong>Fix these errors:</strong>
    <ul class="mb-0 mt-2">
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="card card-primary card-outline">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Edit Category</h3>
      <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.categories.index') }}">Back</a>
    </div>
  </div>

  <form action="{{ route('admin.categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card-body">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" name="name" value="{{ old('name', $category->name) }}" />
      </div>
    </div>

    <div class="card-footer d-flex gap-2">
      <button class="btn btn-primary" type="submit">Update</button>
      <a class="btn btn-outline-secondary" href="{{ route('admin.categories.index') }}">Cancel</a>
    </div>
  </form>
</div>

@endsection
