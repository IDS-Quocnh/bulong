@extends('layouts.app')

@section('content')
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

    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search Confessions" aria-label="Search">

      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </form>

  </div>
</nav>

<div class="bg-secondary">
  <div class="container">
    <div class="row">
      <!-- left sidebar -->
      @include('front.sidebar.left')

      <div class="col-md-6">

        <div class="row mb-2">
          <div class="col-md-12">
            <div class="d-flex flex-column align-items-center mt-4">
              <h4 class="mt-2"><i class="fa fa-bell"></i> Notifications</h4>
            </div>
          </div>
        </div>

        <div class="row">
          <div style="background: white; width: 100%;">
            @forelse (auth()->user()->notifications as $notification)
            <div class="d-flex align-items-center p-2">
              @if($notification->type == 'App\Notifications\FeltConfession')
              <div><i class="fa fa-heart"></i></div>
              @else
              <div><i class="fa fa-comment"></i></div>
              @endif
              <div class="ml-2 p-1">
                <a href="#">
                  {{ $notification->data['username'] }}
                </a>
                @if($notification->type == 'App\Notifications\FeltConfession')
                  felt your
                @else
                  commented on your
                @endif
                <a href="#">
                  {{ $notification->data['confession'] }}
                </a>
              </div>
            </div>
            @empty
              <div class="p-2">You do not have any notifications.</div>
            @endforelse

          </div>
        </div>
      </div>

      <!-- right sidebar -->
      @include('front.sidebar.right')
    </div>
  </div>
</div>
@stop
