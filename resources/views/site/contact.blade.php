@extends('site.layout')

@section('title', 'Alpha Nerd | Contact')

@push('styles')
<style>
  .contact-form{
    display:grid;
    gap:14px;
  }

  .contact-input,
  .contact-textarea{
    width:100%;
    border:1px solid var(--border);
    background:rgba(11,15,20,.35);
    color:var(--text);
    border-radius:12px;
    padding:12px 14px;
    outline:0;
    font-family:inherit;
    font-size:12px;
  }

  .contact-textarea{
    min-height:160px;
    resize:vertical;
  }

  .contact-btn{
    border:1px solid transparent;
    background:var(--accent);
    color:#0B0F14;
    padding:12px 16px;
    border-radius:12px;
    cursor:pointer;
    font-weight:900;
    font-family:inherit;
    font-size:12px;
    width:max-content;
  }
</style>
@endpush

@section('content')

<section class="section">
  <div class="section-head">
    <h2 class="small-title">Contact</h2>
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

  <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
    @csrf

    <input class="contact-input" type="text" name="name" placeholder="Your name" value="{{ old('name') }}">
    <input class="contact-input" type="email" name="email" placeholder="Your email" value="{{ old('email') }}">
    <input class="contact-input" type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}">
    <textarea class="contact-textarea" name="message" placeholder="Write your message...">{{ old('message') }}</textarea>

    <button class="contact-btn" type="submit">Send Message</button>
  </form>
</section>

@endsection
