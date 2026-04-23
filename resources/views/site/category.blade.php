<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alpha Nerd | Categories</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800&family=Noto+Sans+Mono:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('site/style.css') }}">

  <style>
    .chips{display:flex; gap:10px; flex-wrap:wrap}

    .chip-link{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      padding:8px 12px;
      border-radius:999px;
      border:1px solid var(--border);
      background:rgba(11,15,20,.25);
      color:var(--muted);
      text-decoration:none;
      font-size:12px;
      font-weight:900;
      transition: .15s ease;
    }
    .chip-link:hover{
      border-color: color-mix(in srgb, var(--accent) 55%, var(--border));
      color: var(--text);
      box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent) 14%, transparent);
    }
    .chip-link.active{
      background: color-mix(in srgb, var(--accent) 12%, transparent);
      border-color: color-mix(in srgb, var(--accent) 35%, var(--border));
      color: var(--text);
    }

    .cat-card{display:flex; gap:16px; align-items:center;}
    .cat-thumb{flex:0 0 230px; width:230px; display:block; text-decoration:none; color:inherit;}
    .cat-thumb .thumb{width:100%; height:140px; display:block; border-radius:14px; object-fit:cover;}
    .cat-thumb > .thumb{width:100%; height:140px; border-radius:14px;}
    .cat-content{flex:1; min-width:0;}
    .cat-content .badge{position:static !important; margin-bottom:8px; display:inline-flex;}

    @media (max-width:700px){
      .cat-card{flex-direction:column; align-items:stretch;}
      .cat-thumb{width:100%; flex:0 0 auto;}
      .cat-thumb .thumb, .cat-thumb > .thumb{height:220px;}
    }
  </style>
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
          <path d="M3 10.5 12 3l9 7.5"></path><path d="M5 10v10h14V10"></path>
        </svg>
        <span class="nav-label">Home</span>
      </a>

      <a class="nav-item" href="{{ route('categories') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 4h7v7H4z"></path><path d="M13 4h7v7h-7z"></path>
          <path d="M4 13h7v7H4z"></path><path d="M13 13h7v7h-7z"></path>
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
          <path d="M4 4h16v16H4z"></path><path d="m4 6 8 7 8-7"></path>
        </svg>
        <span class="nav-label">Contact</span>
      </a>
    </nav>

    <div class="actions">
      <span class="divider" aria-hidden="true"></span>

      @auth
    @if(auth()->user()->is_admin)
    <a class="admin-btn" href="{{ route('admin.dashboard') }}">DashBoard</a>
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

    <section class="section">
      <div class="section-head">
        <h2 class="small-title">Categories</h2>
      </div>

      @php $activeCat = request('cat', ''); @endphp

      <div class="chips">
        <a class="chip-link {{ $activeCat === '' ? 'active' : '' }}" href="{{ route('categories') }}">All</a>

        @foreach($categories as $c)
          <a class="chip-link {{ $activeCat === $c->name ? 'active' : '' }}" href="{{ route('categories', ['cat' => $c->name]) }}">
            {{ $c->name }}
          </a>
        @endforeach
      </div>

      <p style="margin:12px 0 0; color:var(--muted); font-size:12px; line-height:1.7;">
        Browse posts by category.
      </p>
    </section>

    <section class="section" style="margin-top:18px;">
      <div class="section-head">
        <h2 class="small-title" style="font-size:20px;">Posts</h2>
      </div>

      <div class="post-list">
        @forelse($posts as $post)
          <article class="post-card cat-card">
            <a class="cat-thumb" href="{{ route('posts.show', $post) }}">
              @if($post->image)
                <img class="thumb" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
              @else
                <div class="thumb"></div>
              @endif
            </a>

            <div class="cat-content">
              <span class="badge"><span class="dot"></span>{{ $post->category?->name ?? 'General' }}</span>

              <a href="{{ route('posts.show', $post) }}" style="text-decoration:none;">
                <h3 class="title">{{ $post->title }}</h3>
              </a>

              <div class="meta">
                <span>{{ $post->created_at->toFormattedDateString() }}</span>
                <span>by {{ $post->author?->name ?? 'Admin' }}</span>
              </div>

              <p class="excerpt">{{ \Illuminate\Support\Str::limit($post->content, 140) }}</p>
            </div>
          </article>
        @empty
          <p style="color:var(--muted);">No posts yet.</p>
        @endforelse
      </div>

      <div class="pagination-wrap" style="margin-top:16px;">
        {{ $posts->links('pagination::bootstrap-5') }}
      </div>
    </section>

  </div>
</main>

<footer class="footer">
  <div class="container">© {{ date('Y') }} - {{ date('Y') - 1 }} Alpha Nerd</div>
</footer>

</body>
</html>
