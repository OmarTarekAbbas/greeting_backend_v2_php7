@extends('greeting.master')
@section('style')
<style>
	img {
		display: block;
		margin: 20px auto;
        width: 90%;
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

        <img src='{{asset("$Response[0]")}}'/>

        <a class="action-button" href='{{asset("$Response[0]")}}'>تحميل</a>
    </fieldset>


    {!! Form::close()!!}
@stop
