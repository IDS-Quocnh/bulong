@extends('layouts.admin.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Confessions</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Confessions</a></li>
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
                @if($confessions)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Confessions</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Username</td>
                                        <td>Email</td>
                                        <td>Gender</td>
                                        <td>Category</td>
                                        <td>Text</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($confessions as $confession)
                                    <tr>
                                        <td>{{ $confession->id }}</td>
                                        <td>{{ $confession->user->username }}</td>
                                        <td>{{ $confession->user->email }}</td>
                                        <td>{{ $confession->user->gender }}</td>
                                        <td>{{ $confession->category->name }}</td>
                                        <td>{{ str_limit($confession->text, 30) }}</td>
                                        <td>
                                            <form action="{{ route('admin.confessions.destroy', $confession['id']) }}" method="post" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.confessions.show', $confession['id']) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Show</a>

                                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $confessions->links() }}
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
