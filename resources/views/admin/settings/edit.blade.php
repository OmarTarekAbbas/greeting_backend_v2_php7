@extends('admin.master')
@section('title')
Edit Setting
@endsection
@section('PageTitle')
Edit Setting
@endsection
@section('PageDesc')
Edit Setting
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/settings') }}"> Settings</a></li>
<li class="active">Edit</li>
@endsection
@section('PageContent')
<style>
    .row{
        margin-bottom: 10px;
    }
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            {!! Form::model($setting,['method'=>'PATCH','action'=>['SettingsController@update',$setting->id]]) !!}
            
            @include('admin.settings.form')
           
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
