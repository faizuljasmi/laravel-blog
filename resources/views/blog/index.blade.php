@extends('layouts.home')

@section('css')
  <link rel="stylesheet" href="{{asset('/css/blog-home.css')}}">
@endsection

@section('content')
  <h1 class="my-4">My Blog</h1>

  @forelse($posts as $p)
    <div class ="card mb-4">
      <img class="card-img-top" src="{{$p->cover_image_url}}">
      <div class="card-body">
        <h2 class="card-title">{{$p->title}}</h2>
        <p class="card-text">
            {{Str::limit($p->body,200)}}
        </p>
        <a href="{{route('blog_post',$p)}}" class="btn btn-primary">Read more &rarr;</a>
      </div>
      <div class="card-footer text-muted">
          Posted on {{$p->created_at->format('F d, Y')}} by {{$p->author}}
      </div>
    </div>
  @empty
  <div class="alert alert-warning text-center">Nothing to show here!</div>

  @endforelse

  @if($posts->total() > 0)
  <ul class="pagination justify-content-center mb-4">
    <!-- With condition: if current page is last page,disable older button -->
    <li class="page-item {{! $posts->hasMorePages() ? 'disabled' : ''}}">
      <a href="{{$posts->nextPageUrl()}}" class="page-link">&larr; Older</a>
    </li>
    <!-- With condition: if current page is 1(newest), disable newer button -->
    <li class="page-item {{$posts->currentPage() == 1 ? 'disabled' : ''}}">
      <a href="{{$posts->previousPageUrl()}}" class="page-link">Newer &rarr;</a>
    </li>
  </ul>
  @endif


@endsection
