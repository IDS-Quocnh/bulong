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
            </ol>
            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
        </div>
    </div>
</div>
@stop

@section('content')
<section class="content">
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-md-12">
                @if($advertisements)
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Advertisements</h4>
                                <a href="{{ route('admin.advertisements.create') }}">
                                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                                </a>
                            </div>
                            <table class="table mt-2">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Ad. Banner</td>
                                        <td>Ad. Link</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($advertisements as $advertisement)
                                    <tr>
                                        <td>{{ $advertisement->id }}</td>
                                        <td>
                                            <img src="{{ $advertisement->image }}" width="100">
                                        </td>
                                        <td>
                                            <a href="{{ $advertisement->url }}" target="_blank">Ad. URL</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.advertisements.destroy', $advertisement['id']) }}" method="post" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.advertisements.edit', $advertisement) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>

                                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $advertisements->links() !!}
                        </div>
                        <!-- /.box-body -->
                    </div>
                @endif
        </div>
    </div>
</section>
@endsection
