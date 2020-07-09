@extends('admin.master')
@section('title')
    Edit News
@endsection
@section('PageTitle')
    Edit News
@endsection
@section('PageDesc')
    Edit News ({{ $news->id }})
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/news') }}"> News</a></li>
    <li class="active">Edit</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::model($news,['method'=>'PATCH','action'=>['NewsController@update',$news->id],'files'=>true]) !!}
                {!! Form::hidden('redirects_to', URL::previous()) !!}
                @include('admin.news.form')
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
