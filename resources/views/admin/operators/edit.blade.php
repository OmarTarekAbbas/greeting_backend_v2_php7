@extends('admin.master')
@section('title')
    Edit Operator
@endsection
@section('PageTitle')
    Edit Operator
@endsection
@section('PageDesc')
    Edit Operator ({{ $Operator->name }})
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/operator') }}"> Operators</a></li>
    <li class="active">Edit</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::model($Operator,['method'=>'PATCH','action'=>['OperatorsController@update',$Operator->id]]) !!}
                {!! Form::hidden('redirects_to', URL::previous()) !!}
                @include('admin.operators.form')
                <div class="form-group">
                    <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Edit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <span class="divider"></span>
    </div>


@endsection