@extends('admin.master')
@section('title')
    Edit Content Provider
@endsection
@section('PageTitle')
    Edit Content Provider
@endsection
@section('PageDesc')
    Edit Content Provider ({{ $Cprovider->name }})
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/cproviders') }}"> Content Providers</a></li>
    <li class="active">Edit</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::model($Cprovider,['method'=>'PATCH','action'=>['CprovidersController@update',$Cprovider->id]]) !!}
                {!! Form::hidden('redirects_to', URL::previous()) !!}
                @include('admin.cproviders.form')
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