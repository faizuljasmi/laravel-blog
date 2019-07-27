@extends('layouts.home')

@section('css')
  <link rel="stylesheet" href="{{asset('/css/blog-post.css')}}">
@endsection

@section('content')
    <h1 class="mt-4">{{$post->title}}</h1>
    <p class="lead">by <a href="#">{{$post->author}}</a></p>
    <hr>
    <p>Posted on {{$post->created_at->format('F d, Y \a\t h:iA')}}</p>
    <hr>
    <img src="{{$post->cover_image_url}}" class="img-fluid rounded">
    <hr>
    @foreach($post->categories as $category)
      <div class="badge badge-pill badge-info text-white mb-3">{{$category->name}}</div>
    @endforeach
    <p>{{$post->body}}</p>

    @if($errors->has('message'))
    <div class="alert alert-danger">
      {{$errors->first('message')}}
    </div>
    @endif

    <!-- Comment section -->
    <div class="card my-4">
        <div class="card-header">Leave a comment:</div>
        <div class="card-body">

          @auth
          <form action="{{route('posts_comment',$post)}}" method="POST">
            @csrf
              <div class="form-group">
                <textarea name="message" rows="5" class="form-control {{$errors->has('message') ? 'is-invalid':''}}"></textarea>
                <div class="invalid-feedback">{{$errors->first('message')}}</div>
              </div>
              <button type="submit" class="btn btn-primary"> Post Comment</button>
            </form>
            @endauth

            @guest
            <div class="card-text"><a href="{{url('/login')}}">Login</a> or <a href="{{url('/register')}}">register</a> to post comment.</div>
            @endguest
        </div>
      </div>

      <div class="card my-4">
        <div class="card-header">Comments:</div>
        <div class="card-body">
      @foreach($post->comments()->latest()->get() as $comment)
      <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="{{$comment->user->avatar}}" alt="">
          <div class="media-body">
            <h5 class="mt-0">{{$comment->user->name}}</h5>
              {{$comment->message}}
              <div class="row mb-3">
                <div class="col-2">
                  <small class="text-muted">
                    {{$comment->created_at->diffForHumans()}}
                  </small>
                </div>

                @auth
                <div class="col-2">
                  <small><a href="#reply_{{$comment->id}}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="reply_{{$comment->id}}">Reply</a></small>
                </div>
                @can('delete',$comment)
                <div class="col-2">
                  <small><a href="{{route('posts_comment_delete',$comment)}}" onclick="return confirm('Are you sure?')">Delete</a></small>
                </div>
                @endcan
                @endauth
              </div>
              <form action="{{route('posts_comment_reply',$post)}}" method="POST" class="mb-4 collapse" id="reply_{{$comment->id}}">
                @csrf
                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                <div class="form-group">
                  <textarea name="message" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Reply</button>
              </form>

              <!-- Start Replies -->
              @foreach($comment->replies as $reply)
              <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="{{$reply->user->avatar}}" alt="">
                <div class="media-body">
                  <h5 class="mt-0">{{$reply->user->name}}</h5>
                  {{$reply->message}}
                  <div class="row">
                    <div class="col-3">
                      <small class="text-muted">
                        {{$reply->created_at->diffForHumans()}}
                      </small>
                    </div>
                    @can('delete',$reply)
                    <div class="col-3">
                      <small><a href="{{route('posts_comment_delete',$reply)}}" onclick="return confirm('Are you sure?')">Delete</a></small>
                    </div>
                    @endcan
                  </div>
                </div>
              </div>
              @endforeach
                      <hr>
                </div>
              </div>
              @endforeach
            </div>
          </div>


@endsection
