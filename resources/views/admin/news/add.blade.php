@extends('admin.master')
@section('title')
    Create News
@endsection
@section('PageTitle')
    Create News
@endsection
@section('PageDesc')
    You can add and delete News
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/news') }}"> News</a></li>
    <li class="active">Create News</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::open(['url'=>'admin/news','files'=>true]) !!}
                @include('admin.news.form')
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
