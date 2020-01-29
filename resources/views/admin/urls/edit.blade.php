@extends('admin.master')
@section('title')
    Edit URL
@endsection
@section('PageTitle')
    Edit URL
@endsection
@section('PageDesc')
    Edit URL
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/generateurls') }}"> URL</a></li>
    <li class="active">Edit</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::model($GeneratedURL,['method'=>'PATCH','action'=>['GenerateurlController@update',$GeneratedURL->id],'files'=>true]) !!}
                {!! Form::hidden('redirects_to', URL::previous()) !!}
                @include('admin.urls.form')
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        if ($("input[name='img']:checked").length > 0 && $("input[name='video']:checked").length > 0) {  
            $(".occasion").show();
        }
        $('.switchery').click(function () {         
            if ($("input[name='img']:checked").length > 0 && $("input[name='video']:checked").length > 0) {                
                $(".occasion").show();
            } else {
                $(".occasion").hide();
            }
        })
    });
</script> 
@endsection