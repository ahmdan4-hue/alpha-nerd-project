@extends('admin.layouts.adminlte')

@section('title','Deleted Messages')
@section('heading','Deleted Messages')

@section('content')

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Deleted Messages</h3>
      <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm">
        Back to Messages
      </a>
    </div>
  </div>

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0 align-middle text-nowrap">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Deleted At</th>
            <th style="width:280px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        @forelse($messages as $message)
          <tr>
            <td>{{ $message->name }}</td>
            <td>{{ $message->email }}</td>
            <td>{{ $message->subject }}</td>
            <td>{{ $message->deleted_at }}</td>
            <td>
              <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.messages.deleted.show', $message->id) }}" class="btn btn-sm btn-outline-secondary">
                  View
                </a>

                <form method="POST" action="{{ route('admin.messages.restore', $message->id) }}">
                  @csrf
                  <button class="btn btn-sm btn-success" type="submit">Restore</button>
                </form>

                <form method="POST" action="{{ route('admin.messages.forceDelete', $message->id) }}" onsubmit="return confirm('Delete permanently?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit">Hard Delete</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-4">No deleted messages found.</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="card-footer">
    {{ $messages->links() }}
  </div>
</div>

@endsection
