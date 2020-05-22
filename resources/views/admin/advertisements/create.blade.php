@extends('layouts.admin.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Advertisements</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Advertisements</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="POST" action="{{ route('admin.advertisements.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ad. Banner Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ad. URL</label>
                            <input type="text" class="form-control" placeholder="Enter advertisement url" name="url">
                        </div>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        <a href="{{ route('admin.advertisements.index') }}">
                            <button type="button" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
