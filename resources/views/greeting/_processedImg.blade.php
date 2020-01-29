@extends('greeting.master')
@section('style')
<style>
	img {
		display: block;
		margin: 20px auto;
       width: 90% !important;;

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


@if($Response[0] !== null))
@section('form')
    {!! Form::open(['id'=>'greetingForm']) !!}

    <fieldset id="enterName">
        <h2>صورة التهنئة</h2>
        <div>  

            <div class="url" style="background: #F5F5F5 !important;">
                <a   class="button"   href="{{url('img/'.$Response[1])}}"> تحميل</a>

            </div>
            <img   src='{{asset("$Response[0]")}}'  />


            <a class="action-button no-float" href="{{url('img/'.$Response[1])}}">تحميل<i class="fa fa-download"></i></a>
        </div>

    </fieldset>

    {!! Form::close()!!}
@stop

@endif
