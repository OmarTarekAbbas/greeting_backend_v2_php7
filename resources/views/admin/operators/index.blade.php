@extends('admin.master')
@section('title')
    Operators
@endsection
@section('PageTitle')
    Operators
@endsection
@section('PageDesc')
    You can add and delete Operators
@endsection
@section('breadcrumb')
    <li class="active">Operators</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="right">
            <a href="{{ url('admin/operator/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Operator Name</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($Operators as $Operator)
                            <tr>
                                <td>{{ $Operator->id }}</td>
                                <td><a href="{{ url('admin/operator/'.$Operator->id) }}"> {{ $Operator->name }}</a></td>
                                <td><a href="{{ url('admin/country/'.$Operator->country->id ) }}"> {{ $Operator->country->name }}</a></td>
                                <td>@if(!$Operator->close) Open @else Close @endif</td>
                                <td>
                                    {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('OperatorsController@edit', $Operator->id))) !!}
                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    {!! Form::close() !!}
                                    {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('OperatorsController@destroy', $Operator->id))) !!}
                                    <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete {{ $Operator->name }}')">
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

    {!! $Operators->setPath('operator') !!}

    <div class="row">
        <span class="divider"></span>
    </div>


@endsection
