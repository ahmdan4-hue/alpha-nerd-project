@extends('site.layout')

@section('title', $post->title . ' | Alpha Nerd')

@section('content')

<section class="section post-hero">
  <span class="badge"><span class="dot"></span>{{ $post->category?->name ?? 'General' }}</span>

  <h1 class="post-title">{{ $post->title }}</h1>

  <div class="meta" style="margin-bottom:14px;">
    <span>{{ $post->created_at->toFormattedDateString() }}</span>
    <span>by {{ $post->author?->name ?? 'Admin' }}</span>
  </div>

  @if($post->image)
    <img class="thumb" src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="height:220px; width:100%; object-fit:cover; border-radius:18px; display:block;">
  @else
    <div class="thumb" style="height:220px;"></div>
  @endif

  <div class="post-body" style="margin-top:16px;">
    <p style="white-space: pre-wrap; margin:0;">{{ $post->content }}</p>
  </div>
</section>

<section class="section" style="margin-top:18px;">
  <div class="section-head" style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
    <h2 class="small-title" style="font-size:20px;">Comments</h2>

    @guest
      <a class="btn-outline" href="{{ route('login') }}">Sign in to comment</a>
    @endguest
  </div>

  @if(session('success'))
    <div class="comment-success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div style="margin-top:12px; padding:12px; border:1px solid var(--border); border-radius:12px; background:rgba(255,80,80,.12);">
      <ul style="margin:0; padding-left:18px;">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  @auth
    <form action="{{ route('comments.store', $post) }}" method="POST" style="margin-top:12px;">
      @csrf
      <label style="display:block;margin:10px 0 6px;color:var(--muted);font-size:12px;">Write a comment</label>
      <textarea name="content" class="c-input" placeholder="Type your comment...">{{ old('content') }}</textarea>

      <div style="display:flex; gap:10px; margin-top:10px; flex-wrap:wrap;">
        <button class="c-btn" type="submit">Post Comment</button>
      </div>
    </form>
  @endauth

  <div class="c-list">
    @forelse($post->comments as $c)
      <div class="c-card">
        <div class="c-head">
          <strong class="c-name">{{ $c->user?->name ?? 'User' }}</strong>
          <span class="c-time">{{ $c->created_at->diffForHumans() }}</span>
        </div>

        <p class="c-body">{{ $c->content }}</p>

        <div class="c-actions">
          @auth
            @if(auth()->user()->is_admin || auth()->id() === $c->user_id)
              <form method="POST" action="{{ route('comments.destroy', $c) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="c-del">Delete</button>
              </form>
            @endif
          @endauth
        </div>
      </div>
    @empty
      <p style="color:var(--muted); font-size:12px; margin:12px 0 0;">No comments yet.</p>
    @endforelse
  </div>
</section>

@endsection
