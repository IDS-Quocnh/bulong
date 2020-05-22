@extends('front.layouts.master')
@section('content')
@include('front.includes.banner_ad')
<user-info :user="{{ $user }}" :total-followers="{{ $user->followers()->count() }}"></user-info>
<user-based-confessions :id="{{ $user->id }}"></user-based-confessions>
@stop
