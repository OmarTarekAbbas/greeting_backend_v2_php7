<div class="form-group">
    {!! Form::label('title', 'Image Title', ['class'=>'control-label']) !!}
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
            {!! Form::text("title[$language->short_code]", (isset($GreetingImg)) ? $GreetingImg->getTranslation('title',$language->short_code):null, ['class'=>'form-control','maxlenght'=>60,'placeholder'=>"$language->title" ]) !!}
          </div>
        @endforeach


      </div>

</div>
{{--
<div class="form-group">

    <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
</div>
--}}
<div class="form-group">
    {!! Form::label('file', 'Snap Image File', ['class'=>'control-label']) !!}
    {!! Form::file('file', ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('occasion_id', 'Select occasion', ['class'=>'control-label']) !!}
    {{-- @if(!isset($GreetingImg)) --}}
    {!! Form::select('occasion_id', $Occasions, null, ['id' => 'occasion_list' ,'class'=>'form-control']) !!}
    {{-- @else
    {!! Form::select('occasion_id', $Occasions, null, ['id' => '' ,'class'=>'form-control' ,'']) !!}
    @endif --}}
</div>
<div class="form-group margin-top-20">
    <input type="checkbox" class="js-switch" id="checkbox" name="featured" @if(isset($GreetingImg) && $GreetingImg->featured==1) checked @endif/><label for="checkbox" class="font-size-12 normal margin-left-10">Featured</label>
</div>

<div class="form-group margin-top-20"id="snap_link" >
    {!! Form::label('snap_link', 'Snap Link', ['class'=>'control-label']) !!}
    {!! Form::text('snap_link',  null, ['class'=>'form-control']) !!}

</div>

<div class="form-group">
    {!! Form::label('snap_vid', 'Snap Video Link', ['class'=>'control-label']) !!}
    <ul id="myTab1" class="nav nav-tabs">
          <li class="active"><a href="#Internal" data-toggle="tab"> Internal</a></li>
          {{-- <li class=""><a href="#External" data-toggle="tab"> External</a></li> --}}
      </ul>
      <br>
        <div class="tab-content">
            <div class="tab-pane fade in {{'active'}}" id="Internal">
                {!! Form::label('vid_file', 'Select video file', ['class'=>'control-label']) !!}
                {!! Form::file('vid_file', ['class'=>'form-control']) !!}
            </div>
            {{-- <div class="tab-pane fade in" id="External">
                {!! Form::label('snap_vid', 'External Link', ['class'=>'control-label']) !!}

                {!! Form::text('snap_vid',  null, ['class'=>'form-control']) !!}
            </div> --}}
        </div>
        <div class="form-group">
            {!! Form::label('imgPreFile', 'Image Preview File', ['class'=>'control-label']) !!}
            {!! Form::file('imgPreFile', ['class'=>'form-control']) !!}
        </div>
        @if(isset($GreetingImg) && $GreetingImg->vid_path)
        <div class="row" style="margin-top:30px;">
            
            <video class="col-md-3" width="" src="{{url('/'.$GreetingImg->vid_path)}}" controls></video>
            <img class="col-md-3" width="" src="{{url('/'.$GreetingImg->vid_type)}}" controls/>

        </div>
        @endif

</div>

@if(Auth::user()->admin == true)
<div class="form-group">
    {!! Form::label('operator_list', 'Select Operator') !!}
    {!! Form::select('operator_list[]',$operators,null,['id'=>'operator_list','class'=>'form-control','multiple']) !!}

</div>
<div class="form-group" style="margin-bottom: 25px;">
    <div class="row">
        <div class="col-xs-6">

            {!! Form::label('RDate', 'Start Date', ['class'=>'control-label']) !!}
            <div class="input-group ">
                {!! Form::text('RDate',null,['class'=>'form-control datepicker','id'=>'RDate']) !!}
                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
        <div class="col-xs-6">
            {!! Form::label('EXDate', 'End Date', ['class'=>'control-label']) !!}
            <div class="input-group ">
                {!! Form::text('EXDate',null,['class'=>'form-control datepicker','id'=>'EXDate']) !!}
                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
    </div>
</div>
@endif


