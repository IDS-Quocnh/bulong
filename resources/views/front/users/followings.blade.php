@extends('front.layouts.master')
@section('content')
@include('front.includes.banner_ad')
<div class="flex flex-wrap">
    @foreach($followings as $person)
        <following :person="{{ $person }}"></following>
    @endforeach
</div>
@stop
