@extends('greeting.master')
@section('style')
    <style>
        #progressbar {
            width: 80%;
            margin: 15px auto 20px;
        }

        #progressbar li{
            width: 50%;
        }
    </style>
@stop
@section('form')
    <!--<form id="greetingForm">-->
    {!! Form::open(['id'=>'greetingForm','action'=>'FrontEndController@processImage','method' => 'get']) !!}
    <!-- progress bar -->
    <div>
        {{--@if($errors->any())
            <ul class="alert-box warning round">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif--}}
    </div>
    <ul id="progressbar" class="cf">
        <li class="active">المناسبة</li>
        <li>الاسم</li>
    </ul>

    <!-- fieldsets -->
    <fieldset id="picture">
        <h2>اختر المناسبة</h2>
        {!! Form::select('occasion_id',$occasions,$default,['id'=>'chooseOccasion','data-url'=>'images']) !!}

        <!-- hidden input for operator_id -->
        {!! Form::hidden('operator_id',$url->operator_id,['id'=>'operator_id'])!!}

        <!-- the options are generated by script-->
        <h2>اختر الصورة</h2>
        <div id="thumbnails-container" class="cf">
            <select id="choosePicture" name="image" class="image-picker ajax-select">
                @include('greeting._chooseImg')
            </select>
        </div>

        <input type="button" name="next" class="next action-button ajax-select" value="استمرار" data-ajax="true" data-api="providers" data-layout="drop" data-results-container="chooseProvider" data-other="chooseOccasion"/>

    </fieldset>


    <fieldset id="enterName">
        <h2>اكتب الاسم</h2>
        <input type="text" name="name"/>

        <input type="submit" id="submit" class="submit action-button" value="انتهاء"/>
        <input type="button" name="previous" class="previous action-button" value="رجوع" />
    </fieldset>


    {!! Form::close()!!}
    <!--<div class="clearFooter"></div>-->
@stop
@section('script')
    <script>

        $(function(){
            /*
             *  select menu with image options
             */
            $('#choosePicture').imagepicker();

            /*
             *  onchange event on select occasion to load images for occasion
             */
            $('#chooseOccasion').on('change',function(){
                var occasion_id   = $(this).val();
                var operator_id   = $('#operator_id').val();
                var url           = $(this).attr('data-url');

                // send data with ajax
                $.ajax({
                    type:'GET',
                    url: url,
                    data:{
                        operator_id: operator_id,
                        occasion_id: occasion_id
                    },
                    success:function(result){
                        //console.log(result);
                        //change html of image select with the result images
                        $('#choosePicture').html(result);

                        //BUG: call image picker again
                        $('#choosePicture').imagepicker();
                    }
                });
            });//end change event



        });//end ready

    </script>
@stop