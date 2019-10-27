@extends('admin.master')
@section('title')
Create Snap for operator
@endsection
@section('PageTitle')
Create Snap for operator
@endsection
@section('PageDesc')
Create Snap for operator
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/occasions') }}"> Occasions</a></li>
<li class="active">Create New</li>
@endsection
@section('PageContent')


@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> {{  Session::get('success') }}
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            {!! Form::open(['url'=>'operatorAddSnapFromCategoySave','files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('occasion_id', 'Select Occasion', ['class'=>'control-label']) !!}
                {!! Form::select('occasion_id', $Occasions, null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('operator_id', 'Select Operator', ['class'=>'control-label']) !!}
                {!! Form::select('operator_id[]', $Operators, null, ['id' => 'operator_list','class'=>'form-control' ,'multiple'] ) !!}
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
