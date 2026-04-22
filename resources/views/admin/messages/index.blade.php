@extends('admin.layouts.adminlte')

@section('title','Messages')
@section('heading','Messages')

@section('content')

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h3 class="card-title mb-0">Messages Table</h3>

      <div class="d-flex gap-2">
        <a href="{{ route('admin.messages.deleted') }}" class="btn btn-outline-danger btn-sm">
          Deleted Messages
        </a>
      </div>
    </div>
  </div>

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0 align-middle text-nowrap">
        <thead>
          <tr>
            <th style="width:80px;">ID</th>
            <th style="width:180px;">Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th style="width:160px;">Date</th>
            <th style="width:220px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        @forelse($messages as $message)
          <tr>
            <td>{{ $message->id }}</td>
            <td>{{ $message->name }}</td>
            <td>{{ $message->email }}</td>
            <td>{{ $message->subject }}</td>
            <td>{{ $message->created_at?->format('Y-m-d') }}</td>
            <td>
              <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-outline-secondary">
                  View
                </a>

                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger"
                          type="submit"
                          onclick="return confirm('Delete this message?')">
                    Delete
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4">No messages found.</td>
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
