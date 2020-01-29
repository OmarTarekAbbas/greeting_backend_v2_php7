@extends('admin.master')
@section('title')
Create Greeting Audio
@endsection
@section('PageTitle')
Create Greeting Audio
@endsection
@section('PageDesc')
You can add and delete Greeting Audio
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/gaudios') }}"> Greeting Audio</a></li>
<li class="active">Create New</li>
@endsection
@section('PageContent')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            {!! Form::open(['url'=>'admin/gaudios','files'=>true]) !!}
            @include('admin.gaudios.form')
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