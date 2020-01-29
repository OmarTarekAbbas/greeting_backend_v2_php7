@extends('admin.master')
@section('title')
    Create Operator
@endsection
@section('PageTitle')
    Create Operator
@endsection
@section('PageDesc')
    You can add and delete Operators
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/operator') }}"> Operators</a></li>
    <li class="active">Create New</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::open(['url'=>'admin/operator']) !!}

                <input type="integer" hidden="hidden" value="{{$id}}" name="country_id">

                <div class="form-group">
                    {!! Form::label('name', 'Operator Name',['class'=>'control-label']) !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Operator Name']) !!}
                </div>



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