@if(isset($_REQUEST['occasion_id']))
<div class="form-group">
    {!! Form::label('occasion_id', 'Select  Occasion', ['class'=>'control-label']) !!}
    <select class="form-control" name="occasion_id">
      <option value="{{$_REQUEST['occasion_id']}}">{{$_REQUEST['title']}}</option>
    </select>
</div>
@else
<div class="form-group">
    {!! Form::label('occasion_id', 'Select Occasion', ['class'=>'control-label']) !!}
    {!! Form::select('occasion_id',$occasions->pluck('title','id'), null, ['class'=>'form-control']) !!}
</div>
@endif

<div class="form-group">
    {!! Form::label('title', 'News title', ['class'=>'control-label']) !!}
    {!! Form::text("title",null, ['class'=>'form-control' , 'id' => 'title','maxlenght'=>60 ,'placeholder'=>"News title" ]) !!}
</div>

<div class="form-group">
  {!! Form::label('description', 'News description', ['class'=>'control-label']) !!}
  {!! Form::textarea("description",null, ['class'=>'form-control ckeditor' , 'id' => 'description','placeholder'=>"News description" ]) !!}
</div>

<div class="form-group">
    @if($news)
      <img src="{{$news->image}}" width="200" height="100" alt="">
    @endif
    <br>
    {!! Form::label('file', 'Select Image', ['class'=>'control-label']) !!}
    {!! Form::file('image', ['class'=>'form-control']) !!}
</div>

<div class="form-group" style="margin-bottom: 25px;">
    <div class="row">
        <div class="col-xs-12">
            {!! Form::label('published_date', 'Pblished Date', ['class'=>'control-label']) !!}
            <div class="input-group ">
                {!! Form::text('published_date',null,['class'=>'form-control datepicker']) !!}
                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
    </div>
</div>

