<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Laravel Awesome Blog</title>

  <!-- Bootstrap core CSS -->
  <!-- CHANGE -->
  <link href="{{asset('/css/app.css')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <!-- <link href="css/blog-home.css" rel="stylesheet"> -->
  <!-- DYNAMIC -->
  @yield('css')


</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">Laravel Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          @guest
          <li class="nav-item">
            <a href="{{url('/login')}}" class="nav-link">Login</a>
          </li>
          <li class="nav-item">
            <a href="{{url('/register')}}" class="nav-link">Register</a>
          </li>
          @endguest
          @auth
          <li class="nav-item">
            <a href="{{url('/home')}}" class="nav-link">Admin</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        @yield('content')
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <form action="{{route('blog_search')}}" method="GET">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for..." name="keyword">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </span>
            </div>
          </form>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  @foreach($categories as $id => $name)
                    <li>
                      <a href="{{route('blog_categories',$id)}}">{{$name}}</a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Faizul's First Laravel Project 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <!-- CHANGE, DAH ADA -->
  <!-- <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <script src="{{asset('/js/app.js')}}"></script>

</body>

</html>
