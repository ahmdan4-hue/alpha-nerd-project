@extends('site.layout')

@section('title', 'Alpha Nerd | Contact')

@push('styles')
<style>
  .two-col{
    display:grid;
    grid-template-columns: 1.2fr .8fr;
    gap:18px;
  }

  .section,
  .section p,
  .section span,
  .section div,
  .section label,
  .section input,
  .section textarea,
  .section button,
  .section a,
  .section li{
    font-family:'Noto Sans Mono', monospace !important;
  }

  .small-title,
  .info-row h4{
    font-family:'Orbitron', sans-serif !important;
  }

  .input{
    width:100%;
    border:1px solid var(--border);
    background:rgba(11,15,20,.35);
    color:var(--text);
    border-radius:12px;
    padding:12px 14px;
    outline:0;
    font-family:'Noto Sans Mono', monospace !important;
    font-size:12px;
    margin-top:6px;
  }

  .input::placeholder,
  .contact-input::placeholder,
  .contact-textarea::placeholder{
    font-family:'Noto Sans Mono', monospace !important;
  }

  textarea.input{
    min-height:160px;
    resize:vertical;
  }

  .info-row{
    display:flex;
    gap:12px;
    align-items:flex-start;
    padding:12px;
    border:1px solid var(--border);
    border-radius:14px;
    background:rgba(11,15,20,.25);
  }

  .info-row .icon{
    width:42px;
    height:42px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:12px;
    border:1px solid var(--border);
    background:rgba(11,15,20,.35);
    flex-shrink:0;
  }

  .info-row .icon svg{
    width:18px;
    height:18px;
  }

  .info-row h4{
    margin:0 0 4px;
    font-size:13px;
  }

  .info-row p{
    margin:0;
    color:var(--muted);
    font-size:12px;
  }

  .muted{
    color:var(--muted);
    font-size:12px;
    line-height:1.8;
  }

  @media (max-width:900px){
    .two-col{
      grid-template-columns:1fr;
    }
    .contact-form > div{
  margin-bottom: 14px;
}

.contact-form label{
  display:block;
  margin-bottom:10px;
}

.contact-form .input{
  margin-top:0;
}
  }
</style>
@endpush

@section('content')

<section class="section">
  <div class="section-head">
    <h2 class="small-title">Contact</h2>
  </div>
  <p class="muted">
    Have a question, feedback, or want to report an issue? Send a message and I’ll reply when possible.
  </p>
</section>

<section class="two-col" style="margin-top:18px;">
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

      <div style="display:flex; gap:14px; margin-top:14px; flex-wrap:wrap;">
        <button class="btn primary" type="submit">Send</button>
        <a class="btn" href="{{ route('home') }}">Back to Home</a>
      </div>
    </form>
  </section>

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
            <path d="M12 21s-6-4.35-6-10a6 6 0 1 1 12 0c0 5.65-6 10-6 10z"></path>
            <circle cx="12" cy="11" r="2.5"></circle>
          </svg>
        </div>
        <div>
          <h4>Location</h4>
          <p>Palestine</p>
        </div>
      </div>

      <div class="info-row">
        <div class="icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.86 19.86 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.86 19.86 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.63 2.62a2 2 0 0 1-.45 2.11L8 9.91a16 16 0 0 0 6.09 6.09l1.46-1.29a2 2 0 0 1 2.11-.45c.84.3 1.72.51 2.62.63A2 2 0 0 1 22 16.92z"></path>
          </svg>
        </div>
        <div>
          <h4>Response</h4>
          <p>I usually reply as soon as possible.</p>
        </div>
      </div>
    </div>
  </aside>
</section>

@endsection
