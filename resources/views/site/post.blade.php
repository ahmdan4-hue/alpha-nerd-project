<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $post->title }} | Alpha Nerd</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800&family=Noto+Sans+Mono:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('site/style.css') }}">
</head>
<body>

<header class="header">
  <div class="container header-inner">
    <a class="logo" href="{{ route('home') }}">
      <span class="logo-badge">A</span>
      <span class="logo-text"><span>Alpha</span> Nerd</span>
    </a>

    <nav class="nav-icons" aria-label="Primary">
      <a class="nav-item" href="{{ route('home') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 10.5 12 3l9 7.5"></path>
          <path d="M5 10v10h14V10"></path>
        </svg>
        <span class="nav-label">Home</span>
      </a>

      <a class="nav-item" href="{{ route('categories') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 4h7v7H4z"></path>
          <path d="M13 4h7v7h-7z"></path>
          <path d="M4 13h7v7H4z"></path>
          <path d="M13 13h7v7h-7z"></path>
        </svg>
        <span class="nav-label">Categories</span>
      </a>

      <a class="nav-item" href="{{ route('search') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="7"></circle>
          <path d="M21 21l-4.3-4.3"></path>
        </svg>
        <span class="nav-label">Search</span>
      </a>

      <a class="nav-item" href="{{ route('contact') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 4h16v16H4z"></path>
          <path d="m4 6 8 7 8-7"></path>
        </svg>
        <span class="nav-label">Contact</span>
      </a>
    </nav>

    <div class="actions">
      <span class="divider" aria-hidden="true"></span>

      @auth
        @if(auth()->user()->is_admin)
          <a class="admin-btn" href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endif
      @endauth

      @guest
        <a class="link" href="{{ route('register') }}">Join</a>
        <a class="btn-outline" href="{{ route('login') }}">Sign in</a>
      @endguest

      @auth
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <button class="btn-outline" type="submit">Logout</button>
        </form>
      @endauth
    </div>
  </div>
</header>

<main class="page">
  <div class="content">

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

  </div>
</main>

<footer class="footer">
  <div class="container">© {{ date('Y') }} - {{ date('Y') - 1 }} Alpha Nerd</div>
</footer>

</body>
</html>
