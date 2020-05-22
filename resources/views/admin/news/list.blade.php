@extends('layouts.admin.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Blogs</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                <a href="{{ route('admin.news.create') }}">
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                </a>
            </ol>
            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
        </div>
    </div>
</div>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.errors-and-messages')
            <!-- Default box -->
                @if($news)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">News</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Image</td>
                                        <td>Title</td>
                                        <td>Description</td>
                                        <td>Status</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($news as $record)
                                    <tr>
                                        <td>{{ $record['id'] }}</td>
                                        <td>
                                            <img src="{{ $record->image }}" class="img img-responsive" width="100">
                                        </td>
                                        <td>{{ $record['title'] }}</td>
                                        <td>{!! str_limit($record['description'], 100) !!}</td>
                                        <td>@include('layouts.status', ['status' => $record['status']])</td>
                                        <td>
                                            <form action="{{ route('admin.news.destroy', $record['id']) }}" method="post" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.news.show', $record['id']) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Show</a>
                                                    <a href="{{ route('admin.news.edit', $record['id']) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $news->links() }}
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                @endif
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
