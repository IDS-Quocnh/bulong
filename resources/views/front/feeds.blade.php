@extends('layouts.app')

@section('content')

@push('css')

@endpush

@push('scripts')

@endpush

@include('front.layouts.navbar')

<div class="bg-secondary">
  <div class="container">
    <div class="row">
      <!-- <div class="col-md-3 mt-4">
        <div class="d-flex flex-end">
            <img src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user" class="img-circle" width="40">
            <h5 class="ml-2">minimalist_ken</h5>
        </div>

        <div class="bg-white rounded">
          <ul class="text-right list-unstyled p-2">
            <li class="">My Confessions <span class="ml-2"><i class="fa fa-caret-right"></i></span></li>
            <li class="">My Felt Confessions <span class="ml-2"><i class="fa fa-caret-right"></i></span></li>
            <li class="">Notifications <span class="ml-2"><i class="fa fa-caret-right"></i></span></li>
          </ul>
        </div>

        <h5 class=""><strong>Categories</strong></h5>

        <div class="bg-white rounded">
          <ul class="list-unstyled p-2">
            @foreach($categories as $category)
            <a href="{{ route('confession-categories.index', $category->slug) }}">
              <li class=""><span class="mr-2">
                <img src="{{ $category->image }}" class="img img-responsive img-circle" width="15">
                </span> {{ $category->name }} <i class="fa fa-caret-right pull-right"></i>
              </li>
            </a>
            @endforeach
          </ul>
        </div>

        <h5><strong>Trending Hashtags</strong></h5>

        <div class="bg-white rounded">
          <ul class="list-unstyled p-2">
            <li class=""># Love and Relationship</li>
            <li class=""># Love and Relationship</li>
            <li class=""># Love and Relationship</li>
            <li class=""># Love and Relationship</li>
            <li class=""># Love and Relationship</li>
          </ul>
        </div>
      </div> -->
      @include('front.sidebar.left')

      <div class="col-md-6 col-sm-12">
        <confess-now></confess-now>

        <!-- <h5 class="mt-4"><strong><a href="{{ route('blogs') }}">Blog</a></strong></h5>
        <div class="row">
          @foreach($news as $record)
          <div class="col-md-4">
            <div class="card mb-3">
              <img class="card-img-top" src="{{ $record->image }}" alt="Card image cap">
              <div class="card-body bg-white">
                <a href="{{ route('blogs.show', $record->slug) }}">
                  <p class="card-text">{{ str_limit($record->title, 25) }}</p>
                </a>
              </div>
          </div>
          </div>
          @endforeach
        </div> -->

        <feed></feed>

      </div>

      @include('front.sidebar.right')
    </div>
  </div>
</div>
@stop
