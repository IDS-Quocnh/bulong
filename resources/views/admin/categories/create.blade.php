@extends('admin.layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Categories</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active">Create</li>
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
                    <form class="form-material form-horizontal" method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12" for="name">Category Name
                            </label>
                            <div class="col-md-12">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter category name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="image">Category Image
                            </label>
                            <div class="col-md-12">
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="btn-group">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
