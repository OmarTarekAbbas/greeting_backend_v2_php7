@extends('greeting.master')
@section('style')
    <style>
        video {
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
        <h2>فيديو التهنئة</h2>

        <video controls>
        	<source src='{{asset("$Response[0]")}}' type="video/mp4">
        </video> 

        <a class="action-button" href='{{asset("$Response[0]")}}'>تحميل</a>
    </fieldset>


    {!! Form::close()!!}
@stop
