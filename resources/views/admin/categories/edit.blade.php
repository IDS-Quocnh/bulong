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
                    <form class="form-material form-horizontal" method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="put">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12" for="name">Category Name
                            </label>
                            <div class="col-md-12">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter category name" value="{{ $category->name ?: old('name') }}">
                            </div>
                        </div>

                        @if(isset($category->image))
                        <div class="form-group">
                            <div class="col-md-12">
                                <img src="{{ $category->image }}" alt="" class="img-responsive" width="50"> <br/>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="col-md-12" for="image">Category Image
                            </label>
                            <div class="col-md-12">
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="btn-group">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
