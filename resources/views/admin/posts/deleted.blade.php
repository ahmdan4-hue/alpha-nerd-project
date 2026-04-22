@extends('admin.layouts.adminlte')

@section('title','Deleted Posts')
@section('heading','Deleted Posts')

@section('content')

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Deleted Posts</h3>
      <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-sm">Back to Posts</a>
    </div>
  </div>

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover text-nowrap mb-0">
        <thead>
          <tr>
            <th>Title</th>
            <th>Deleted At</th>
            <th style="width:280px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($posts as $post)
            <tr>
              <td>{{ $post->title }}</td>
              <td>{{ $post->deleted_at }}</td>
              <td>
                <div class="d-flex gap-2 flex-wrap">
                  <a href="{{ route('admin.posts.deleted.show', $post->id) }}" class="btn btn-sm btn-outline-secondary">
                    View
                  </a>

                  <form method="POST" action="{{ route('admin.posts.restore', $post->id) }}">
                    @csrf
                    <button class="btn btn-sm btn-success" type="submit">Restore</button>
                  </form>

                  <form method="POST" action="{{ route('admin.posts.forceDelete', $post->id) }}" onsubmit="return confirm('Delete permanently?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Hard Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center py-4">No deleted posts found.</td>
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
