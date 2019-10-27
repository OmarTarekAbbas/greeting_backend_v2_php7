<!-- ========================================================================= -->
@extends('front.template')
@section('content')
    <?php $title = "الصور"; ?>
<style type="text/css">
    footer {
        position: fixed;
        width: 100%;
        bottom: 0;
    }
</style>
<!-- ========================================================================= -->
{!! Form::open(['id'=>'greetingForm','action'=>['FrontEndController@processImage',UID()],'method' => 'post','class'=>"form_input image"]) !!}
    <div>
        <input type="hidden" name="image" value="{{$image_id}}"/>
        <label for="">اكتب النص</label>
        <input type="text" name="name" placeholder="اكتب النص ...." required>
    </div>

    <input type="submit" class="btn-link" value="إنتهاء" >
</form>
<a class="btn-link" href="{{ URL::previous() }}">رجوع</a>
<!-- ========================================================================= -->
@stop
@section('script')
<script>  
   $('a[href="{{url("imgs/".UID())}}"]').addClass('active_header'); 
</script>
@stop

<!-- ========================================================================= -->