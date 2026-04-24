@extends('site.layout')

@section('title', 'Alpha Nerd | Blog')

@section('content')

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

@endsection

@push('scripts')
<script>
  function scrollTrending(dir){
    const el = document.getElementById("trendingSlider");
    const amount = Math.round(el.clientWidth * 0.75) * dir;
    el.scrollBy({ left: amount, behavior: "smooth" });
  }
</script>
@endpush
