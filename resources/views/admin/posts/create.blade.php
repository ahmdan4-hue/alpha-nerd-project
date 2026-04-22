@extends('admin.layouts.adminlte')

@section('title','Create Post')
@section('heading','Create Post')

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
      <h3 class="card-title mb-0">New Post</h3>
      <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>
  </div>

  <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card-body">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Post title...">
      </div>

      <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select">
          <option value="">-- None --</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Image</label>
        <input class="form-control" type="file" name="image" accept="image/*">
        <div class="form-text">jpg / jpeg / png / webp up to 2MB</div>
      </div>

      <div class="mb-0">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="10" placeholder="Write your post...">{{ old('content') }}</textarea>
      </div>
    </div>

    <div class="card-footer">
      <button class="btn btn-primary" type="submit">Save</button>
      <a class="btn btn-outline-secondary" href="{{ route('admin.posts.index') }}">Cancel</a>
    </div>
  </form>
</div>

@endsection
