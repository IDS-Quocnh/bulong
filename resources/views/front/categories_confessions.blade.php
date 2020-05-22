@extends('front.layouts.master')

@section('content')
<confession-form></confession-form>
<div class="flex flex-col justify-center items-center mt-4">
    <img src="{{ $category->image }}" class="h-16 w-16">
    <h1 class="text-lg mt-2 text-gray-900">{{ $category->name }}</h1>
</div>
<!-- @foreach($confessions as $confession)
<confession :confession="{{ $confession }}"></confession>
@endforeach -->
<category-based-confession :id="{{ $category->id }}"></category-based-confession>
@stop
