@extends('layouts.app')

@section('content')
@include('front.layouts.navbar')

<div class="bg-secondary">
  <div class="container">
    <div class="row">
      <!-- left sidebar -->
      @include('front.sidebar.left')

      <div class="col-md-6">
        <h5 class="mt-4"><strong>Blog</strong></h5>
        <div class="row">
          @foreach($blogs as $blog)
          <div class="col-md-4">
            <div class="card mb-3">
              <img class="card-img-top" src="{{ $blog->image }}" alt="Card image cap">
              <div class="card-body bg-white">
                <!-- <h5 class="card-title">10 romantic confessions</h5> -->
                <p class="card-text">
                  <a href="{{ route('blogs.show', $blog->slug) }}">{{ str_limit($blog->title, 25) }}</a>
                </p>
                <!-- <p class="card-text"><small class="text-muted">Added 3 mins ago</small></p> -->
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- right sidebar -->
      @include('front.sidebar.right')
    </div>
  </div>
</div>
@stop
