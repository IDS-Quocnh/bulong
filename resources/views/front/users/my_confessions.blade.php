@extends('front.layouts.master')
@section('content')
@include('front.includes.banner_ad')
@foreach($confessions as $confession)
<confession :confession="{{ $confession }}"></confession>
@endforeach
@stop
