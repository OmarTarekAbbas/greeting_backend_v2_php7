@extends('admin.master')
@section('title')
Create Greeting Rbt
@endsection
@section('PageTitle')
Create Greeting Rbt
@endsection
@section('PageDesc')
You can add and delete Greeting Rbt
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/grbts') }}"> Greeting Rbt</a></li>
<li class="active">Create New</li>
@endsection
@section('PageContent')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            {!! Form::open(['url'=>'admin/grbts','files'=>true]) !!}
            @include('admin.grbts.form')
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
@section('script')
<script>
    $(document).ready(function () {
        $('#add').click(function () {
            $('#rbt_code').append("<div class='row'>" + $('#first_row').html() + '<a class="btn btn-circle btn-danger  del"><i class="fa fa-trash"></i></a></div>');
        });
        $(document).on("click", ".del", function () {
            $(this).closest('div.row').remove();
        });
    });
</script>

@endsection