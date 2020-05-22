@extends('layouts.app')

@section('content')
@include('front.layouts.navbar')

<div class="bg-secondary">
  <div class="container">
    <div class="row">
      <!-- left sidebar -->
      @include('front.sidebar.left')

      <div class="col-md-6">
        <h5 class="mt-4"><strong>Blog >> {{ str_limit($blog->title, 40) }}</strong></h5>
        <img src="{{ $blog->image }}" class="img img-responsive mt-4">
        <p class="mt-4">{!! $blog->description !!}</p>
      </div>

      <!-- right sidebar -->
      @include('front.sidebar.right')
    </div>
  </div>
</div>
@stop
