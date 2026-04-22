@extends('admin.layouts.adminlte')

@section('title','View Deleted Message')
@section('heading','View Deleted Message')

@section('content')

<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="card-title mb-0">Deleted Message</h3>
      <a href="{{ route('admin.messages.deleted') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>
  </div>

  <div class="card-body">
    <p><strong>Name:</strong> {{ $message->name }}</p>
    <p><strong>Email:</strong> {{ $message->email }}</p>
    <p><strong>Subject:</strong> {{ $message->subject }}</p>
    <p><strong>Message:</strong></p>
    <div class="border rounded p-3 bg-body-tertiary mb-3">
      {!! nl2br(e($message->message)) !!}
    </div>
    <p><strong>Deleted At:</strong> {{ $message->deleted_at }}</p>

    <div class="mt-4 d-flex gap-2 flex-wrap">
      <form method="POST" action="{{ route('admin.messages.restore', $message->id) }}">
        @csrf
        <button class="btn btn-success" type="submit">Restore</button>
      </form>

      <form method="POST" action="{{ route('admin.messages.forceDelete', $message->id) }}" onsubmit="return confirm('Delete permanently?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Hard Delete</button>
      </form>
    </div>
  </div>
</div>

@endsection
