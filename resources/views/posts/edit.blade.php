@extends('layouts.app')

@section('content')
<div class ="container">
  <div class ="row">
    <div class="col-md-12">
      <h1 class="page-header">Edit Post</h1>
        @include('posts.partials.form', ['action' => route('posts_update', $post), 'post' => $post])
    </div>
  </div>
</div>
@endsection
