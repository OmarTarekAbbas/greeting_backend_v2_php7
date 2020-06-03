<div class="form-group">
    {!! Form::label('occasion_id', 'Select occasion', ['class'=>'control-label']) !!}
    {!! Form::select('occasion_id', $Occasions, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('operator_id', 'Select Operator', ['class'=>'control-label']) !!}
    {!! Form::select('operator_id', $Operators, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group margin-top-20">
    <input type="checkbox" class="js-switch" id="checkbox" name="img" @if($GeneratedURL && $GeneratedURL->img==1) checked @endif/><label for="checkbox" class="font-size-12 normal margin-left-10">Image</label>
</div>
{{--<div class="form-group margin-top-20">
    <input type="radio" class="js-switch" id="checkbox" name="type" value="audio" /><label for="checkbox" class="font-size-12 normal margin-left-10">Audio</label>
</div>--}}
<div class="form-group margin-top-20">
    <input type="checkbox"  class="js-switch" id="checkbox" name="video" @if($GeneratedURL && $GeneratedURL->video==1) checked @endif /><label for="checkbox" class="font-size-12 normal margin-left-10">Video</label>
</div>
<div class="occasion"style="display: none">
    <div class="form-group">
        {!! Form::label('url_occasion_text', 'Url Occasion Text', ['class'=>'control-label']) !!}
        {!! Form::textarea('url_occasion_text', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('file', 'Select Occasion Image', ['class'=>'control-label']) !!}
        {!! Form::file('file', ['class'=>'form-control']) !!}
    </div>
    @if($GeneratedURL && $GeneratedURL->url_occasion_image)
    <div class="form-group">
        <img src="{{url($GeneratedURL->url_occasion_image)}}" alt="" class="img-thumbnail" style="height:200px"/>
    </div>
    @endif
</div>