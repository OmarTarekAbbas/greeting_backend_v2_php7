@extends('admin.master')
@section('title')
    Edit Occasion
@endsection
@section('PageTitle')
    Edit Occasion
@endsection
@section('PageDesc')
    Edit Occasion ({{ $Occasion->title }})
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/operator') }}"> Occasions</a></li>
    <li class="active">Edit</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::model($Occasion,['method'=>'PATCH','action'=>['OccasionsController@update',$Occasion->id],'files'=>true]) !!}
                {!! Form::hidden('redirects_to', URL::previous()) !!}
                @include('admin.occasions.form')
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