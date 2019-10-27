@extends('admin.master')
@section('title')
    Create Operator
@endsection
@section('PageTitle')
    Create Operator
@endsection
@section('PageDesc')
    You can add and delete Operators
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/operator') }}"> Operators</a></li>
    <li class="active">Create New</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::open(['url'=>'admin/operator']) !!}
                @include('admin.operators.form')
                <div class="form-group">
                    <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span>Add</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <span class="divider"></span>
    </div>


@endsection