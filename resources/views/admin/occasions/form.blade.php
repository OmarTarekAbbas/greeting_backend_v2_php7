@if(isset($_REQUEST['parent_id']))
<div class="form-group">
    {!! Form::label('parentid', 'Select Parent Occasion', ['class'=>'control-label']) !!}
    <select class="form-control" name="parent_id">
      <option value="{{$_REQUEST['parent_id']}}">{{$_REQUEST['title']}}</option>
    </select>
</div>
@else
<div class="form-group">
    {!! Form::label('parent_id', 'Select Parent Occasion', ['class'=>'control-label']) !!}
    {!! Form::select('parent_id',$occasion_parent, null, ['class'=>'form-control parent_select']) !!}
</div>
@endif

<div class="form-group">
    {!! Form::label('title', 'Occasion name', ['class'=>'control-label']) !!}
    {!! Form::text('title', null, ['class'=>'form-control','maxlenght'=>60]) !!}
</div>
<div class="form-group">
    {!! Form::label('category_id', 'Select Category', ['class'=>'control-label']) !!}
    {!! Form::select('category_id', $Categories, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('file', 'Select Image', ['class'=>'control-label']) !!}
    {!! Form::file('image', ['class'=>'form-control']) !!}
</div>

 @if($Occasion && $Occasion->image)
    <div class="form-group">
        <img src="{{url($Occasion->image)}}" alt="" class="img-thumbnail" style="height:200px"/>
    </div>
@endif

<div class="form-group">
    <label class=" control-label">Slider<span class="text-danger">*</span></label>
    {!! Form::select('slider',array('1' => 'YES' , '0' => 'NO'),null,['class'=>'form-control']) !!}
</div>
