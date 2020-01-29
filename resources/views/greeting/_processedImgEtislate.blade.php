@extends('greeting.master_etislate')
@section('style')
<style>
	img {
		display: block;
		margin: 20px auto;
        width: 90%;
        max-width: 500px;
	}
	
	fieldset {
		margin-top: 20px;
	}

    .action-button {
        font-weight: normal;
        font-size: 14px;
    }
</style>
@stop
@section('form')
    {!! Form::open(['id'=>'greetingForm']) !!}

    <fieldset id="enterName">
        <h2>صورة التهنئة</h2>
        <div>

            <div class="url">
                <a href="{{url('img/'.$Response[1])}}">{{url('img/'.$Response[1])}}</a>
            </div>
            <img src='{{asset("$Response[0]")}}'/>

            <a class="action-button no-float" href="{{url('img/'.$Response[1])}}">تحميل<i class="fa fa-download"></i></a>

        </div>

    </fieldset>

    {!! Form::close()!!}
@stop
