@extends('layouts.admin.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Users</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item item active">Users</li>
            </ol>
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
                @if($users)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Users</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Username</td>
                                        <td>Email</td>
                                        <td>Gender</td>
                                        <td>DOB</td>
                                        <td>Status</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $customer)
                                    <tr>
                                        <td>{{ $customer['id'] }}</td>
                                        <td>{{ $customer['username'] }}</td>
                                        <td>{{ $customer['email'] }}</td>
                                        <td>{{ $customer['gender'] }}</td>
                                        <td>{{ $customer['dob'] }}</td>
                                        <td>@include('layouts.status', ['status' => $customer['status']])</td>
                                        <td>
                                            <form action="{{ route('admin.users.destroy', $customer['id']) }}" method="post" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <div class="btn-group">
                                                    <!-- <a href="{{ route('admin.users.show', $customer['id']) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> Show</a>
                                                    <a href="{{ route('admin.users.edit', $customer['id']) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a> -->
                                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
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
