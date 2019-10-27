@extends('admin.master')
@section('title')
Edit Greeting Notification
@endsection
@section('PageTitle')
Edit Greeting Notification
@endsection
@section('PageDesc')
Edit Greeting Notification
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/gnotifications') }}"> Greeting Notifications</a></li>
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
            {!! Form::model($Greetingaudio,['method'=>'PATCH','files'=>true,'action'=>['GreetingNotificationController@update',$Greetingaudio->id]]) !!}
            {!! Form::hidden('redirects_to', URL::previous()) !!}
            @include('admin.gnotifications.form')
          
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
