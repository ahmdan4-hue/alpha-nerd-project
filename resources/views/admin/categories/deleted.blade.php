@extends('admin.layouts.adminlte')

@section('title','Deleted Categories')
@section('heading','Deleted Categories')

@section('content')

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Deleted Categories</h3>
      <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
        Back to Categories
      </a>
    </div>
  </div>

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0 text-nowrap">
        <thead>
          <tr>
            <th>Name</th>
            <th>Deleted At</th>
            <th style="width:280px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
          <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->deleted_at }}</td>
            <td>
              <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.categories.deleted.show', $category->id) }}" class="btn btn-sm btn-outline-secondary">
                  View
                </a>

                <form method="POST" action="{{ route('admin.categories.restore', $category->id) }}">
                  @csrf
                  <button class="btn btn-sm btn-success" type="submit">Restore</button>
                </form>

                <form method="POST" action="{{ route('admin.categories.forceDelete', $category->id) }}" onsubmit="return confirm('Delete permanently?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit">Hard Delete</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="text-center py-4">No deleted categories found.</td>
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
