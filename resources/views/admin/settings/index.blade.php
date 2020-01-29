@extends('admin.master')
@section('title')
    Settings
@endsection
@section('PageTitle')
    Settings
@endsection
@section('PageDesc')
    You can add and delete Settings
@endsection
@section('breadcrumb')
    <li class="active">Settings</li>
@endsection
@section('PageContent')

<div class="row">   
    <div class="right">
        <a href="{{ url('admin/settings/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>
    
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <br/>
                <table class="table table-hover table-striped datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->key }}</td>
                                <td>{{ $value->value }}</td>
                                <td>
                                    {!! Form::open(array('class' => 'col-xs-1','method' => 'DELETE', 'action' => array('SettingsController@destroy', $value->id))) !!}
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete {{ $value->key }}')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    {!! Form::close() !!}
                                   {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('SettingsController@edit', $value->id))) !!}
                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
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



@stop