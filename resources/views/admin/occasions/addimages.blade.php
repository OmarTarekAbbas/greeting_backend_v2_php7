@extends('admin.master')
@section('title')
    Create Greeting Image
@endsection
@section('PageTitle')
    Create Greeting Image
@endsection
@section('PageDesc')
    You can add and delete Greeting Image
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/gimages') }}"> Greeting Image</a></li>
    <li class="active">Create New</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::open(['files'=>true,'class'=>"dropzone dz-clickable"]) !!}
                    <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <span class="divider"></span>
    </div>


@endsection
