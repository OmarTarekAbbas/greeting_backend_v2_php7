@extends('admin.master')
@section('title')
    Create Occasion
@endsection
@section('PageTitle')
    Create Occasion
@endsection
@section('PageDesc')
    You can add and delete Occasion
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/occasions') }}"> Occasions</a></li>
    <li class="active">Create New</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::open(['url'=>'admin/occasions','files'=>true]) !!}
                @include('admin.occasions.form')
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
