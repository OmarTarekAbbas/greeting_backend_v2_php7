<div class="form-group">
    {!! Form::label('name', 'Operator Name',['class'=>'control-label']) !!}
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Operator Name']) !!}
</div>
<div class="form-group">
    {!! Form::label('country_id', 'Select Country',['class'=>'control-label']) !!}
    {!! Form::select('country_id', $Countries, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('rbt_sms', 'Rbt SMS',['class'=>'control-label']) !!}
    {!! Form::text('rbt_sms', null, ['class'=>'form-control','placeholder'=>'Rbt SMS']) !!}
</div>
<div class="form-group">
  {!! Form::label('Status', 'Status',['class'=>'control-label']) !!}
  {!! Form::select('close',array('0' => 'open','1' => 'close'),null,['class'=>'form-control chosen-rtl','required']) !!}
</div>
