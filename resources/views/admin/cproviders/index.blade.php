@extends('admin.master')
@section('title')
    Content Providers
@endsection
@section('PageTitle')
    Content Providers
@endsection
@section('PageDesc')
    You can add and delete Content Providers
@endsection
@section('breadcrumb')
    <li class="active">Content Providers</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Content Providers</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($Cproviders as $Cprovider)
                            <tr>
                                <td>{{ $Cprovider->id }}</td>
                                <td>{{ $Cprovider->name }}</td>
                                <td>
                                    {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('CprovidersController@edit', $Cprovider->id))) !!}
                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    {!! Form::close() !!}
                                    {!! Form::open(array('class' => 'col-xs-1','method' => 'DELETE', 'action' => array('CprovidersController@destroy', $Cprovider->id))) !!}
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete {{ $Cprovider->name }}')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {!! $Cproviders->setPath('cproviders') !!}
    <div class="row">
        <span class="divider"></span>
    </div>
    <div class="row">
        <div class="col-xs-9">
            <div class="box">

                {!! Form::open() !!}
                    @include('admin.cproviders.form')

                    <div class="form-group">

                        <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span>Add</button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>

    </div>

@endsection