@extends('admin.master')
@section('title')
Edit Greeting Rbt
@endsection
@section('PageTitle')
Edit Greeting Rbt
@endsection
@section('PageDesc')
Edit Greeting Rbt
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/grbts') }}"> Greeting Rbts</a></li>
<li class="active">Edit</li>
@endsection
@section('PageContent')
<style>
    .row{
        margin-bottom: 10px;
    }
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            {!! Form::model($Greetingaudio,['method'=>'PATCH','files'=>true,'action'=>['GreetingRbtController@update',$Greetingaudio->id]]) !!}
            {!! Form::hidden('redirects_to', URL::previous()) !!}
            @include('admin.grbts.form')
           
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
        $(document).on('click', '.del_code', function () {
            var confirmed = confirm('Are you sure you want to delete?');
            if (confirmed) {                
                var ele = $(this);
                var id = $(this).attr('data-id');
                $.ajax({
                    method: "get",
                    url: "<?= url('admin/grbts/del_code') ?>",
                    data: {id: id},
                    success: function (data) {
                        if (data == 'success') {
                            ele.closest('div.row').remove();
                        }
                    }
                });
            }
        });
    });
</script>

@endsection