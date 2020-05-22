@extends('admin.layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Confessions</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.confessions.index') }}">Confessions</a></li>
                <li class="breadcrumb-item active">Show</li>
            </ol>
            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
        </div>
    </div>
</div>
@stop

@section('content')
@include('layouts.errors-and-messages')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-material form-horizontal" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12" for="title">Username
                            </label>
                            <div class="col-md-12">
                                <input type="text" id="title" name="user_id" class="form-control" value="{{ $confession->user->username }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="name">Confess
                            </label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="text" rows="10">{!! $confession->text !!}</textarea>
                                <!-- <textarea class="form-control" name="description" placeholder="Enter description" rows="10"></textarea> -->
                            </div>
                        </div>

                        <div class="btn-group">
                            <a href="{{ route('admin.confessions.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
