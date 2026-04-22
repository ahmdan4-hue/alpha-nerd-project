@extends('admin.layouts.adminlte')

@section('title','Categories')
@section('heading','Categories')

@section('content')

@if(session('success'))
  <div class="alert alert-success mb-3">
    {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h3 class="card-title mb-0">Categories Table</h3>

      <div class="d-flex gap-2">
        <a href="{{ route('admin.categories.deleted') }}" class="btn btn-outline-danger btn-sm">
          Deleted Categories
        </a>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.create') }}">
          + Add Category
        </a>
      </div>
    </div>
  </div>

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0 align-middle text-nowrap">
        <thead>
          <tr>
            <th style="width:90px;">ID</th>
            <th>Name</th>
            <th style="width:220px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td class="fw-semibold">{{ $category->name }}</td>
            <td>
              <div class="d-flex gap-2 flex-wrap">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.edit', $category) }}">
                  Edit
                </a>

                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger"
                          type="submit"
                          onclick="return confirm('Delete this category?')">
                    Delete
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="text-center text-muted py-4">No categories yet.</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="card-footer">
    {{ $categories->links() }}
  </div>
</div>

@endsection
