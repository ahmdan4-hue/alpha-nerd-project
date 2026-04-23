<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alpha Nerd | Blog</title>

  <!-- Fonts: Orbitron + Noto Sans Mono -->
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
          <a class="admin-btn" href="{{ route('admin.dashboard') }}">DashBoard</a>
        @endif

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <button class="btn-outline" type="submit">Logout</button>
        </form>
      @endauth

      @guest
        <a class="link" href="{{ route('register') }}">Join</a>
        <a class="btn-outline" href="{{ route('login') }}">Sign in</a>
      @endguest
    </div>
  </div>
</header>

<main class="page">
  <div class="content">

    <!-- Trending  -->
    <section class="section">
      <div class="section-head">
        <h2 class="small-title">Trending</h2>
      </div>

      <div class="slider-wrap">
        <button class="slider-btn left" type="button" aria-label="Scroll left" onclick="scrollTrending(-1)">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18 9 12l6-6"></path>
          </svg>
        </button>

        <div class="slider" id="trendingSlider">
          @foreach($posts->take(6) as $post)
            <article class="slide">
              <a href="{{ route('posts.show', $post) }}" style="text-decoration:none; color:inherit; display:block;">
                @if($post->image)
                  <img class="thumb" src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="object-fit:cover;">
                @else
                  <div class="thumb"></div>
                @endif

                <h4>{{ \Illuminate\Support\Str::limit($post->title, 42) }}</h4>
                <p>{{ \Illuminate\Support\Str::limit($post->content, 70) }}</p>
              </a>
            </article>
          @endforeach
        </div>

        <button class="slider-btn right" type="button" aria-label="Scroll right" onclick="scrollTrending(1)">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m9 18 6-6-6-6"></path>
          </svg>
        </button>
      </div>
    </section>

    <!-- Latest Posts -->
    <section class="section" style="margin-top:18px;">
      <div class="section-head">
        <h2 class="small-title">Latest Posts</h2>
      </div>

      <div class="post-list">
        @foreach($posts as $post)
          <article class="post-card latest-card">
            <a class="latest-thumb" href="{{ route('posts.show', $post) }}">
              @if($post->image)
                <img class="thumb" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
              @else
                <div class="thumb"></div>
              @endif
            </a>

            <div class="latest-content">
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
        @endforeach
      </div>
    </section>

  </div>
</main>

<footer class="footer">
  <div class="container">© {{ date('Y') }} - {{ date('Y') - 1 }} Alpha Nerd</div>
</footer>

<script>
  function scrollTrending(dir){
    const el = document.getElementById("trendingSlider");
    const amount = Math.round(el.clientWidth * 0.75) * dir;
    el.scrollBy({ left: amount, behavior: "smooth" });
  }
</script>

</body>
</html>
