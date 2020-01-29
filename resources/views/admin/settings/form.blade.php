
<div class="form-group">
    {!! Form::label('key','Key',['class'=>'control-label']) !!}
    {!! Form::text('key',null,['class'=>'form-control',isset($setting)?'readonly':'']) !!}
</div>
<div class="form-group">
    {!! Form::label('value','Value',['class'=>'control-label']) !!}
    {!! Form::text('value',null,['class'=>'form-control']) !!}
</div>


