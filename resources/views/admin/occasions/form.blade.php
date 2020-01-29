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
    <ul id="myTab1" class="nav nav-tabs">
        <?php $i=0;?>
        @foreach($languages as $language)
          <li class="{{($i++)? '':'active'}}"><a href="#translations{{$language->short_code}}" data-toggle="tab"> {{$language->title}}</a></li>
        @endforeach

      </ul>

      <div class="tab-content">
        <?php $i=0;?>
        @foreach($languages as $language)
          <div class="tab-pane fade in {{($i++)? '':'active'}}" id="translations{{$language->short_code}}">
            {!! Form::text("title[$language->short_code]", (isset($Occasion)) ? $Occasion->getTranslation('title',$language->short_code):null, ['class'=>'form-control','maxlenght'=>60,'placeholder'=>"$language->title" ]) !!}
          </div>
        @endforeach
      </div>
</div>
<div class="form-group">
    {!! Form::label('category_id', 'Select Category', ['class'=>'control-label']) !!}
    {!! Form::select('category_id', $Categories, isset($_REQUEST['category_id']) ? $_REQUEST['category_id']:null, ['class'=>'form-control']) !!}
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

<div class="form-group" style="margin-bottom: 25px;">
    <div class="row">
        <div class="col-xs-6">
            {!! Form::label('RDate', 'Start Date', ['class'=>'control-label']) !!}
            <div class="input-group ">
                {!! Form::text('occasion_RDate',null,['class'=>'form-control datepicker']) !!}
                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
        <div class="col-xs-6">
            {!! Form::label('EXDate', 'End Date', ['class'=>'control-label']) !!}
            <div class="input-group ">
                {!! Form::text('occasion_EXDate',null,['class'=>'form-control datepicker']) !!}
                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
    </div>
</div>

