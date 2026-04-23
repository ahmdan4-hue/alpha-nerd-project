<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alpha Nerd | Sign in</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;800&family=Noto+Sans+Mono:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('site/style.css') }}">

  <style>
    .center{
      min-height: calc(100vh - 72px - 70px);
      display:flex;
      align-items:center;
      justify-content:center;
      padding:26px 0;
    }
    .auth{
      width:min(520px, 92%);
      background:linear-gradient(180deg, var(--surface), var(--surface-2));
      border:1px solid var(--border);
      border-radius:20px;
      padding:22px;
    }
    .auth h1{
      font-family:"Orbitron", system-ui, sans-serif;
      margin:0 0 6px;
      font-size:24px;
      letter-spacing:.35px;
    }
    .auth p{
      margin:0 0 18px;
      color:var(--muted);
      font-size:12px;
      line-height:1.6;
    }
    label{
      display:block;
      margin:12px 0 6px;
      color:var(--muted);
      font-size:12px;
    }
    .input{
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
    .row{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      margin-top:12px;
      flex-wrap:wrap;
    }
    .check{
      display:flex;
      align-items:center;
      gap:8px;
      color:var(--muted);
      font-size:12px;
    }
    .check input{accent-color: var(--accent)}
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
    }
    .btn:hover{border-color:color-mix(in srgb, var(--accent) 55%, var(--border))}
    .btn.primary{
      background:var(--accent);
      color:#0B0F14;
      border-color:transparent;
    }
    .full{width:100%}
    .links{
      margin-top:14px;
      color:var(--muted);
      font-size:12px;
      display:flex;
      justify-content:space-between;
      gap:10px;
      flex-wrap:wrap;
    }
    .links a{color:var(--accent)}
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

      <!-- Search -->
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

     <a class="admin-btn" href="{{ route('admin.posts.index') }}">
    DashBoard
     </a>

     <a class="link" href="{{ route('register') }}">Join</a>
    <a class="btn-outline" href="{{ route('login') }}">Sign in</a>
    </div>
  </div>
</header>

<main class="center">
  <section class="auth" aria-label="Sign in form">
    <h1>Sign in</h1>
    <p>This page is UI only for now. Later we will connect real authentication.</p>

    <form action="#" method="post">
      <label for="email">Email</label>
      <input class="input" id="email" type="email" placeholder="name@example.com" />

      <label for="password">Password</label>
      <input class="input" id="password" type="password" placeholder="••••••••" />

      <div class="row">
        <label class="check">
          <input type="checkbox" />
          Remember me
        </label>

        <button type="submit">Forgot your password?</button>
      </div>

      <div style="height:14px;"></div>
      <button class="btn primary full" type="button">Sign in</button>

      <div class="links">
        <span>Don’t have an account?</span>
        <a href="{{ route('register') }}">Create one</a>
      </div>
    </form>
  </section>
</main>

<footer class="footer">
  <div class="container">© {{ date('Y') }} - {{ date('Y') - 1 }} Alpha Nerd</div>
</footer>

</body>
</html>
