@extends('layouts.app')

@section('content')
@include('front.layouts.navbar')

<div class="bg-secondary">
  <div class="container">
    <div class="row">
      <!-- left sidebar -->
      @include('front.sidebar.left')

      <div class="col-md-6">
        <category-based-feed slug="{{ $slug }}" category_name="{{ $category->name }}" category_image="{{ $category->image }}"></category-based-feed>
      </div>

      <!-- right sidebar -->
      @include('front.sidebar.right')
    </div>
  </div>
</div>
@stop
