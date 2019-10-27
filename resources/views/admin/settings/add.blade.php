@extends('admin.master')
@section('title')
Create Setting
@endsection
@section('PageTitle')
Create Setting
@endsection
@section('PageDesc')
You can add and delete Setting
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/settings') }}"> Setting</a></li>
<li class="active">Create New</li>
@endsection
@section('PageContent')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            {!! Form::open(['url'=>'admin/settings']) !!}
            @include('admin.settings.form')
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
