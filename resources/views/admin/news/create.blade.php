@extends('admin.layouts.app')

@push('css')
<!-- summernotes CSS -->
<link href="{{ asset('admin/assets/node_modules/summernote/dist/summernote.css') }}" rel="stylesheet" />
@endpush

@push('js')
<script src="{{ asset('admin/assets/node_modules/summernote/dist/summernote.min.js') }}"></script>

<script>
    jQuery(document).ready(function() {
        $('#summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
    });
    $('.inline-editor').summernote({
        airMode: true
    });
</script>
@endpush

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Blogs</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">Blogs</a></li>
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
                    <form class="form-material form-horizontal" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12" for="title">Title
                            </label>
                            <div class="col-md-12">
                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter news name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="name">Description
                            </label>
                            <div class="col-md-12">
                                <textarea id="summernote" name="description">{!! old('description') !!}</textarea>
                                <!-- <textarea class="form-control" name="description" placeholder="Enter description" rows="10"></textarea> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="image">News Image
                            </label>
                            <div class="col-md-12">
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="btn-group">
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
