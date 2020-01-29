@extends('admin.master')
@section('title')
    Edit Category
@endsection
@section('PageTitle')
    Edit Category
@endsection
@section('PageDesc')
    Edit Category ({{ $Category->title }})
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/categories') }}"> Categories</a></li>
    <li class="active">Edit</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::model($Category,['method'=>'PATCH','action'=>['CategoriesController@update',$Category->id]]) !!}
                {!! Form::hidden('redirects_to', URL::previous()) !!}
                @include('admin.categories.form')
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