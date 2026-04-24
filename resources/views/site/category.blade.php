@extends('site.layout')

@section('title', 'Alpha Nerd | Categories')

@section('content')

<section class="section">
  <div class="section-head">
    <h2 class="small-title">Categories</h2>
  </div>

  <div class="filters" aria-label="Categories">
    <a class="chip-link {{ !request('category') ? 'active' : '' }}" href="{{ route('categories') }}">All</a>

    @foreach($categories as $category)
      <a class="chip-link {{ request('category') === $category->name ? 'active' : '' }}"
         href="{{ route('categories', ['category' => $category->name]) }}">
        {{ ucfirst($category->name) }}
      </a>
    @endforeach
  </div>
</section>

<section class="section" style="margin-top:18px;">
  <div class="post-list">
    @forelse($posts as $post)
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
    @empty
      <p style="color:var(--muted); margin:0;">No posts found in this category.</p>
    @endforelse
  </div>

  <div style="margin-top:16px;">
    {{ $posts->links('pagination::bootstrap-5') }}
  </div>
</section>

@endsection
