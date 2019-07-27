@extends('layouts.app')

@section('content')
<div class ="container">
  <div class ="row">
    <div class="col-md-12">
      <h1 class="page-header">New Post</h1>
        @include('posts.partials.form', ['action' => route('posts_store')])
    </div>
  </div>
</div>
@endsection
