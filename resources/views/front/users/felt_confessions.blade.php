@extends('layouts.app')

@section('content')
@include('front.layouts.navbar')

<div class="bg-secondary">
  <div class="container">
    <div class="row">
      <!-- left sidebar -->
      @include('front.sidebar.left')

      <div class="col-md-6">
      <search-results :feeds="{{ $feeds ?? null }}"></search-results>
      </div>
      <!-- right sidebar -->
      @include('front.sidebar.right')
    </div>
  </div>
</div>
@stop
