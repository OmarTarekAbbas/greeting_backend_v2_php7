<div class="form-group">
    {!! Form::label('title','Audio Title',['class'=>'control-label']) !!}
    {!! Form::text('title',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('file', 'Select greeting file', ['class'=>'control-label']) !!}
    {!! Form::file('file', ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('occasion_id', 'Select occasion', ['class'=>'control-label']) !!}
    {!! Form::select('occasion_id', $Occasions, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('cprovider_id', 'Select Content Provider', ['class'=>'control-label']) !!}
    {!! Form::select('cprovider_id', $Cproviders, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group margin-top-20">
    <input type="checkbox" class="js-switch" id="checkbox" name="featured" @if($Greetingaudio && $Greetingaudio->featured==1) checked @endif/><label for="checkbox" class="font-size-12 normal margin-left-10">Featured</label>
</div> 
@if(Auth::user()->admin == true)

<div class="form-group" id="op_list" >
    {!! Form::label('operator_list', 'Select Operator') !!}
    {!! Form::select('operator_list[]',$operators,null,['id'=>'operator_list','class'=>'form-control','multiple']) !!}
</div>


<div class="form-group" style="margin-bottom: 25px;">
    <div class="row">
        <div class="col-xs-6">

            {!! Form::label('RDate', 'Start Date', ['class'=>'control-label']) !!}
            <div class="input-group ">
                {!! Form::text('RDate',null,['class'=>'form-control datepicker']) !!}
                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
        <div class="col-xs-6">
            {!! Form::label('EXDate', 'End Date', ['class'=>'control-label']) !!}
            <div class="input-group ">
                {!! Form::text('EXDate',null,['class'=>'form-control datepicker']) !!}
                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
    </div>
</div>
@endif