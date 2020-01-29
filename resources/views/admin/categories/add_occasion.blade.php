@extends('admin.master')
@section('title')
    Create Occasion
@endsection
@section('PageTitle')
    Create Occasion
@endsection
@section('PageDesc')
    Add new Occasion
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/occasions') }}"> Occasions</a></li>
    <li class="active">Create New</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::open(['url'=>'admin/occasions']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Occasion name', ['class'=>'control-label']) !!}
                    {!! Form::text('title', null, ['class'=>'form-control','maxlenght'=>60]) !!}
                </div>
                <input type="text" hidden value="{{$id}}" name="category_id">
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