@extends('layouts.app')

@section('content')
<div class ="container">
  <div class ="row">
    <div class="col-md-12">
      @include ('alert')
      <h1 class="page-header">Manage Posts</h1>
      <a href="{{ route ('posts_create')}}" class="btn btn-primary mb-2">New Post</a>
    </div>

    <div class="col-md-12">
      <h4 class="col md-12">
        <h5>
          Displaying {{$posts->count()}} of {{$posts->total()}} records.
        </h5>
      <table class="table table-bordered table-striped">
        <thead>
          <tr class="bg-dark text-white">
            <th>No.</th>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date Created</th>
            <th width="15%">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Important formula to number item per page -->
          @php $count = ($posts->currentPage()-1) * $posts->perPage(); @endphp
          @foreach($posts as $p)
            <tr>
              <td>{{++$count}}</td>
              <td>{{$p->id}}</td>
              <td>{{$p->title}}</td>
              <td>{{$p->author}}</td>
              <td>{{$p->submit_date}}</td>
              <td>
                <a href="{{route('posts_edit', $p)}}" class="btn btn-success">Edit</a>
                <a href="{{route('posts_delete',$p)}}" class="btn btn-danger" onclick="return confirm('Serious ah bro?')">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
      </table>
      <!-- Call pagination navigation -->
      {{$posts->links()}}
  </div>
</div>

@endsection
