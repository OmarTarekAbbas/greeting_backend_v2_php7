<div class="form-group">
	{{-- {!! Form::label('title', 'Category Title', ['class'=>'control-label']) !!}
  {!! Form::text('title', null, ['class'=>'form-control']) !!} --}}
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
          {!! Form::text("title[$language->short_code]", (isset($Category)) ? $Category->getTranslation('title',$language->short_code):null, ['class'=>'form-control','maxlenght'=>60,'placeholder'=>"$language->title" ]) !!}
        </div>
      @endforeach
    </div>
</div>
