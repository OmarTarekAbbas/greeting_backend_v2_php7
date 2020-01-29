@if($Img)
{!! Form::hidden('snapID',$Img->id,'') !!}
@endif
<div class="form-group">
    {!! Form::label('title','Audio Title',['class'=>'control-label']) !!}
    {!! Form::text('title',$Img ? $Img->title:null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('file', 'Select greeting file', ['class'=>'control-label']) !!}
    {!! Form::file('file', ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('occasion_id', 'Select occasion', ['class'=>'control-label']) !!}
    {!! Form::select('occasion_id', $Occasions, $Img ? $Img->occasion_id:null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('cprovider_id', 'Select Content Provider', ['class'=>'control-label']) !!}
    {!! Form::select('cprovider_id', $Cproviders, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group margin-top-20">
    <input type="checkbox" class="js-switch" id="checkbox" name="featured" @if($Greetingaudio && $Greetingaudio->featured==1) checked @endif/><label for="checkbox" class="font-size-12 normal margin-left-10">Featured</label>
</div>

@if(Auth::user()->admin == true)

<div class="form-group" id="rbt_code" style="margin-bottom: 25px;" >
    <a class="btn btn-circle btn-info pull-right" id="add">
        <i class="fa fa-plus"></i>
    </a>
    <div class="clearfix"></div>
    <div class="row" >
        <div class="col-md-6">
            {!! Form::label('operator_id', 'Select Operator') !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('code', 'Code') !!}
        </div>
    </div>
    @if($codes)
    @foreach($codes as $code)
    <div class="row">
        <input type="hidden" name="code_id[]" value="{{$code->id}}"/>
        <div class="col-md-6">
            {!! Form::select('operator_id[]',$operators,$code->operator_id,['class'=>'form-control']) !!}
        </div>
        <div class="col-md-5">
            {!! Form::text('code[]',$code->code,['class'=>'form-control ']) !!}
        </div>
        <a class="btn btn-circle btn-danger  del_code" data-id="{{$code->id}}"><i class="fa fa-trash"></i></a>
    </div>

    @endforeach 
    @endif
    <div class="row" id="first_row" @if(count((array)$codes)>= 1) style='display:none' @endif >
         <div class="col-md-6">
            {!! Form::select('operator_id[]',$operators,null,['class'=>'form-control']) !!}
        </div>
        <div class="col-md-5">
            {!! Form::text('code[]',null,['class'=>'form-control ']) !!}
        </div>
    </div>
</div>


<div class="form-group" style="margin-bottom: 25px;">
    <div class="row">
        <div class="col-xs-6">

            {!! Form::label('RDate', 'Start Date', ['class'=>'control-label']) !!}
            <div class="input-group ">
                {!! Form::text('RDate',$Img ? $Img->RDate:null,['class'=>'form-control datepicker']) !!}
                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
        <div class="col-xs-6">
            {!! Form::label('EXDate', 'End Date', ['class'=>'control-label']) !!}
            <div class="input-group ">
                {!! Form::text('EXDate',$Img ? $Img->EXDate:null,['class'=>'form-control datepicker']) !!}
                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
    </div>
</div>
@endif
