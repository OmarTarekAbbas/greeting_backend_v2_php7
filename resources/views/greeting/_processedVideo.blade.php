@extends('greeting.master')
@section('style')
    <style>
        video {
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
        
      .button {
            background-color: #3067AB;
            color: #fff;
            display:block;
            padding: 10px ;
            width: auto;

        }
        
    </style>
@stop


@section('form')
    {!! Form::open(['id'=>'greetingForm']) !!}
    <fieldset id="enterName">
    	<h2>فيديو التهنئة</h2>
        <div>
            <div class="url">
                <a    class="button" href="{{url('vid/'.$Response[1])}}">تحميل</a>

            </div>
                 <video controls width="80%">
	        	<source src='{{asset("$Response[0]")}}' type="video/mp4">
                <source src="{{asset("$Response[0]")}}" type="video/avi">
	        </video>

          
	        
           <a class="action-button no-float" href="{{url('vid/'.$Response[1])}}"><i class="fa fa-download"></i>تحميل</a>


        </div>

    </fieldset>
    

    {!! Form::close()!!}
@stop
