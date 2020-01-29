@extends('admin.master')
@section('title')
    Generated URLs
@endsection
@section('PageTitle')
    Generated URLs
@endsection
@section('PageDesc')
    You can add and delete Generated URLs
@endsection
@section('breadcrumb')
    <li class="active">Generated URLs</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                {!! Form::open(['url'=>'admin/generateurls','id'=>'checkform','files'=>true]) !!}
                @include('admin.urls.form')
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
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