@extends('admin.master')
@section('title')
Edit Greeting Audio
@endsection
@section('PageTitle')
Edit Greeting Audio
@endsection
@section('PageDesc')
Edit Greeting Audio
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/gaudios') }}"> Greeting Audios</a></li>
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
            {!! Form::model($Greetingaudio,['method'=>'PATCH','files'=>true,'action'=>['GreetingaudiosController@update',$Greetingaudio->id]]) !!}
            {!! Form::hidden('redirects_to', URL::previous()) !!}
            @include('admin.gaudios.form')
            
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
