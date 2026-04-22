<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alpha Nerd | Contact</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800&family=Noto+Sans+Mono:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('site/style.css') }}">
  <style>
    /* Contact-only tweaks (small) */
    .two-col{
      display:grid;
      grid-template-columns: 1.15fr .85fr;
      gap:18px;
    }
    @media (max-width: 900px){
      .two-col{grid-template-columns:1fr}
    }
    label{display:block;margin:12px 0 6px;color:var(--muted);font-size:12px}
    .input, textarea{
      width:100%;
      border:1px solid var(--border);
      background:rgba(11,15,20,.35);
      color:var(--text);
      border-radius:12px;
      padding:11px 12px;
      outline:0;
      font-family: inherit;
      font-size:12px;
    }
    textarea{min-height:130px; resize:vertical}

    .btn{
      border:1px solid var(--border);
      background:transparent;
      color:var(--text);
      padding:10px 12px;
      border-radius:12px;
      cursor:pointer;
      font-weight:900;
      font-family: inherit;
      font-size:12px;
      text-decoration:none;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:8px;
    }
    .btn:hover{border-color:color-mix(in srgb, var(--accent) 55%, var(--border))}
    .btn.primary{background:var(--accent);color:#0B0F14;border-color:transparent}

    .info-row{
      display:flex;gap:10px;align-items:flex-start;
      padding:12px;border:1px solid var(--border);border-radius:14px;
      background:rgba(11,15,20,.35);
    }
    .icon{
      width:34px;height:34px;border-radius:10px;
      background:color-mix(in srgb, var(--accent) 20%, transparent);
      border:1px solid color-mix(in srgb, var(--accent) 35%, var(--border));
      display:grid;place-items:center;flex:0 0 auto;
    }
    .icon svg{width:18px;height:18px}
    .info-row h4{margin:0 0 4px;font-size:13px;font-weight:900}
    .info-row p{margin:0;color:#D1D9E6;font-size:12px;line-height:1.6}
    .muted{color:var(--muted); font-size:12px; line-height:1.7; margin:0}
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
        <h2 class="small-title">Contact</h2>
      </div>
      <p class="muted">
        Have a question, feedback, or want to report an issue? Send a message and I’ll reply when possible.
      </p>
    </section>

    <section class="two-col" style="margin-top:18px;">
      <!-- Form -->
      <section class="section">
        <div class="section-head">
          <h2 class="small-title" style="font-size:20px;">Send a message</h2>
        </div>

        @if (session('success'))
          <div style="margin-bottom:12px; padding:12px; border:1px solid var(--border); border-radius:12px; background:rgba(163,230,53,.12);">
            {{ session('success') }}
          </div>
        @endif

        @if ($errors->any())
          <div style="margin-bottom:12px; padding:12px; border:1px solid var(--border); border-radius:12px; background:rgba(255,80,80,.12);">
            <ul style="margin:0; padding-left:18px;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST">
          @csrf

          <label for="name">Name</label>
          <input class="input" id="name" name="name" type="text" placeholder="Your name" value="{{ old('name') }}" />

          <label for="email">Email</label>
          <input class="input" id="email" name="email" type="email" placeholder="name@example.com" value="{{ old('email') }}" />

          <label for="subject">Subject</label>
          <input class="input" id="subject" name="subject" type="text" placeholder="What is this about?" value="{{ old('subject') }}" />

          <label for="message">Message</label>
          <textarea class="input" id="message" name="message" placeholder="Write your message...">{{ old('message') }}</textarea>

          <div style="display:flex; gap:10px; margin-top:14px; flex-wrap:wrap;">
            <button class="btn primary" type="submit">Send</button>
            <a class="btn" href="{{ route('home') }}">Back to Home</a>
          </div>
        </form>
      </section>

      <!-- Info -->
      <aside class="section">
        <div class="section-head">
          <h2 class="small-title" style="font-size:20px;">Info</h2>
        </div>

        <div style="display:flex; flex-direction:column; gap:12px;">
          <div class="info-row">
            <div class="icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16v16H4z"></path>
                <path d="m4 6 8 7 8-7"></path>
              </svg>
            </div>
            <div>
              <h4>Email</h4>
              <p>admin@alphanerd.test</p>
            </div>
          </div>

          <div class="info-row">
            <div class="icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.9v3a2 2 0 0 1-2.2 2A19.8 19.8 0 0 1 3 5.2 2 2 0 0 1 5 3h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.7a2 2 0 0 1-.5 2.1L9 10.5a16 16 0 0 0 4.5 4.5l1-1.1a2 2 0 0 1 2.1-.5c.9.3 1.8.5 2.7.6A2 2 0 0 1 22 16.9z"></path>
              </svg>
            </div>
            <div>
              <h4>Response time</h4>
              <p>Usually within 24–72 hours.</p>
            </div>
          </div>

          <div class="info-row">
            <div class="icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 3v10"></path>
                <path d="M7 8h10"></path>
                <path d="M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z"></path>
              </svg>
            </div>
            <div>
              <h4>Report a bug</h4>
              <p>Include the page name + what you expected + what happened.</p>
            </div>
          </div>
        </div>
      </aside>
    </section>

  </div>
</main>

<footer class="footer">
  <div class="container">© 2026 Alpha Nerd</div>
</footer>

</body>
</html>
