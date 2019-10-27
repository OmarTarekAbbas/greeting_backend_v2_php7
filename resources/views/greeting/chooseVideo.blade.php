@extends('greeting.master')
@section('style')
    <style>  
        .action-button {
            font-weight: normal;
            font-size: 14px;
        }
        .occasion{
            margin: 80px 10% 20px;
            text-align: center;
            font-family: "Droid Arabic Kufi", sans-serif;
            color:#3067AB;
        } 
        figcaption{       
            font-family: "Droid Arabic Kufi", sans-serif;
        } 
    </style>
@stop
@section('form')
<!--         <div class="occasion">    
            <p>{{$urlDetect[0]->url_occasion_text}}</p>
        </div> -->

    {!! Form::open(['id'=>'greetingForm']) !!}       
        <fieldset id="enterName">
            <a class="choose-link cf" href="{{ url('imgs/'.$UID) }}">
                <p>صور تهنئة</p> 
                <i class="fa fa-picture-o"></i>
            </a>
            <a class="choose-link cf" href="{{ url('vids/'.$UID) }}">
                <p>فيديو تهنئة</p>
                <i class="fa fa-film"></i>
            </a>

        </fieldset>

    {!! Form::close()!!}
        @if($urlDetect[0]->url_occasion_image)        
        <figure class="snip1191 blue">
            <a style="position: initial" href="{{ url('imgs/'.$UID) }}">
                <img src="{{url($urlDetect[0]->url_occasion_image)}}" alt="sample" />
                <figcaption>
                    <h3> {{$urlDetect[0]->occasion->title}}</h3><span>كروت تهنئه</span>
                </figcaption>
            </a>
        </figure>        
        @endif
@stop
