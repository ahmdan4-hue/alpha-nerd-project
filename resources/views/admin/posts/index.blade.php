@extends('admin.layouts.adminlte')

@section('title','Posts')
@section('heading','Posts')

@section('content')

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h3 class="card-title mb-0">Posts Table</h3>

      <div class="d-flex gap-2">
        <a href="{{ route('admin.posts.deleted') }}" class="btn btn-outline-danger btn-sm">
          Deleted Posts
        </a>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">
          + Add New Post
        </a>
      </div>
    </div>
  </div>

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover text-nowrap mb-0">
        <thead>
          <tr>
            <th style="width:70px;">ID</th>
            <th>Title</th>
            <th style="width:180px;">Category</th>
            <th style="width:170px;">Created</th>
            <th style="width:280px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($posts as $post)
            <tr>
              <td>{{ $post->id }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->category?->name ?? '-' }}</td>
              <td>{{ $post->created_at->format('Y-m-d') }}</td>
              <td>
                <div class="d-flex gap-2 flex-wrap">
                  <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                  <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Delete this post?')">
                      Delete
                    </button>
                  </form>

                  <a href="{{ route('posts.show', $post) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                    View
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-4">No posts found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="card-footer clearfix">
    {{ $posts->links() }}
  </div>
</div>

@endsection
