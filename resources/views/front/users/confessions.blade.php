@extends('layouts.app')

@section('content')
@include('front.layouts.navbar')

<div class="bg-secondary">
  <div class="container">
    <div class="row">
      <!-- left sidebar -->
      @include('front.sidebar.left')

      <div class="col-md-6">
        <div class="d-flex flex-column justify-content-center align-items-center mt-4">
          <img src="http://localhost:8000/images/default.png" alt="user" width="40" class="img-circle">
          <a href="#"><span>@</span>{{ $user->username }}</a>
          <button class="btn btn-sm btn-primary my-2">Follow</button>
          <h4 class="font-weight-bold">0 Followers</h4>
        </div>
      <search-results :feeds="{{ $feeds ?? null }}"></search-results>
      </div>
      <!-- right sidebar -->
      @include('front.sidebar.right')
    </div>
  </div>
</div>
@stop
