@extends('front.layouts.master')

@section('content')
<div class="flex flex-col justify-center items-center">
    <h1 class="text-lg mt-2 text-gray-900">Search results for: {{ $query }}</h1>
</div>
@foreach($confessions as $confession)
<confession :confession="{{ $confession }}"></confession>
@endforeach
@stop
