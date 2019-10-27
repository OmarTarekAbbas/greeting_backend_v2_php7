@extends('admin.master')
@section('title')
    Edit User
@endsection
@section('PageTitle')
    Edit User
@endsection
@section('PageDesc')
    Edit User ({{ $User->name }})
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/user') }}"> Users</a></li>
    <li class="active">Edit</li>
@endsection
@section('PageContent')
    <div class="canvas-wrapper col-lg-4">
        {!! Form::model($User,['method'=>'PATCH','action'=>['UsersController@update',$User->id],]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Full Name', ['class'=>'control-label']) !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'E-Mail', ['class'=>'control-label']) !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password', ['class'=>'control-label']) !!}
            <input type="password" name="password" id="password" value="{{$User->password}}" class="form-control">

        </div>
        <div class="form-group">
            {!! Form::label('admin', 'Admin', ['class'=>'control-label']) !!}
            {!! Form::select('admin', [0=>'User',1=>'Admin'], null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Edit</button>
        </div>
        {!! Form::close() !!}
    </div>

@endsection