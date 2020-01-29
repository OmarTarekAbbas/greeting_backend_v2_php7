@extends('admin.master')
@section('title')
Edit Snap Image
@endsection
@section('PageTitle')
Edit Snap Image
@endsection
@section('PageDesc')
Edit Snap Image
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/gsnap') }}"> Snap Images</a></li>
<li class="active">Edit</li>
@endsection
@section('PageContent')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            {!! Form::model($GreetingImg,['method'=>'PATCH','files'=>true,'action'=>['GreetingSnapController@update',$GreetingImg->id]]) !!}
            {!! Form::hidden('redirects_to', URL::previous()) !!}
            @include('admin.gsnap.form')
            
            <br>
            <br>
            <br>            
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

    var token = '{{Session::token()}}';

    $('#occasion_list').on('change', function () {
        $.ajax({
            method: 'POST',
            url: '{{url("admin/date")}}',
            data: {
                 id: $(this).val(),
                 _token: token
                }
        })
        .done(function (data) {
            $('#RDate').val(data.RDate);
            $('#EXDate').val(data.EXDate);
        });
    });

</script>
@endsection