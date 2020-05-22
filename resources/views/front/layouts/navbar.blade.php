<nav class="navbar navbar-expand-lg navbar-dark bg-white border-top-0 border-right-0 border-left-0" style="border: 1px; border-style: dashed;">
<!--  Show this only on mobile to medium screens  -->
  <a class="navbar-brand d-lg-none" href="#">Navbar</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<!--  Use flexbox utility classes to change how the child elements are justified  -->
  <div class="collapse navbar-collapse justify-content-around" id="navbarToggle">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>

    <!--   Show this only lg screens and up   -->
    <a class="navbar-brand d-none d-lg-block" href="{{ route('feeds') }}">
      <img src="{{ asset('images/logo.png') }}" class="img img-responsive" width="200">
    </a>

    <form class="form-inline my-2 my-lg-0" method="POST" action="/search" role="search">
      @csrf
      <input class="form-control mr-sm-2" name="q" type="search" placeholder="Search Confessions" aria-label="Search" value="{{ $query ?? '' }}">

      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </form>

    <!-- <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul> -->
  </div>
</nav>
