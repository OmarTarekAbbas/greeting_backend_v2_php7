<!-- ========================================================================= -->
@extends('front.template')
@section('content')
<?php $title = "الفيديو"; ?>
<style type="text/css">
    footer {
        position: fixed;
        width: 100%;
        bottom: 0;
    }
    .form_input.video div{
        padding: 5px 0!important;
    }
</style>
<!-- ========================================================================= -->
{!! Form::open(['id'=>'theForm','action'=>['FrontEndController@processVideo',UID()],'method' => 'post','class'=>"form_input video"]) !!}

{!! Form::hidden('occasion_id',$image->occasion_id,['id'=>'occasion_id'])!!}
{!! Form::hidden('operator_id',OP(),['id'=>'operator_id'])!!}
{!! Form::hidden('image',$image->id)!!}
<div>
    <label for="">اكتب النص</label>
    <input type="text" name="name" placeholder="اكتب النص ...." required>
</div>

<div class="audio-item" >
    <div class="container" >
        <select name="provider" class="chooseitem" id="chooseProvider" data-url="{{ url('vidoes') }}" required="">
            <option value="" disabled selected>اختر المؤدي</option>
            @foreach($providers as $provider)
            <option value="{{$provider->id}}">{{$provider->name}}</option>
            @endforeach
        </select>
        <h3 class="choose-audio">اختر الصوت</h3>        
        <!--audio-->
        <div id="chooseAudio"></div>
        <!--audio-->
    </div>
</div>
<input type="submit" class="btn-link" value="إنتهاء" form="theForm">
<a class="btn-link" href="{{ URL::previous() }}">رجوع</a>
</form>
<audio id="audio_test" controls="controls" style="display:none">
    <source id="audioSource" src="">
</audio>
<!-- ========================================================================= -->
@stop
@section('script')
<script>
    $('a[href="{{url("vids/".UID())}}"]').addClass('active_header');
    $(function () {
        $('form').trigger("reset");
        $('.choose-audio').hide();
        $('#chooseProvider').on('change', function () {
            $('.choose-audio').show();
            var cprovider_id = $(this).val();
            var occasion_id = $('#occasion_id').val();
            var operator_id = $('#operator_id').val();
            var url = $(this).attr('data-url');
            // send data with ajax
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    operator_id: operator_id,
                    cprovider_id: cprovider_id,
                    occasion_id: occasion_id
                },
                success: function (result) {
                    //console.log(result);
                    //change audios
                    $('#chooseAudio').html(result);


                }
            });
        });//end change event

    });//end ready

</script>
@stop
<!-- ========================================================================= -->