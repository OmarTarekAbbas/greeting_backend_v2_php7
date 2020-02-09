@extends('admin.master')

@section('title')
    Add User
@stop

@section('PageName')
    Add User
@stop

@section('PageContent')
      {!! Form::open(['url'=>'admin/user', 'class'=>'mtform']) !!}


<div class="form-group">
	<div class="row">
		
	    <div class="col-xs-12">
	    <div class="row">
	        <div class="col-xs-4">
	            <div class="input-group">
		            {!! Form::label('name', 'Name :') !!}
		            {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Name']) !!}
	            </div>
	        </div>
	        <div class="col-xs-4">
	            <div class="input-group">
	                {!! Form::label('password', 'Password :') !!}
	                {!! Form::password('password', ['class'=>'form-control','placeholder'=>'Password']) !!}
	            </div>
	        </div>
	        <div class="col-xs-4">
	            <div class="input-group">
					{!! Form::label('MobNum', 'Mobile Number :') !!}
					{!! Form::text('MobNum', null, ['class'=>'form-control','placeholder'=>'Mobile Number']) !!}
	            </div>
	        </div>
	        </div>
	    </div>
	    <br>
	    <br>
	    <br>
	    <br>
	    <div class="row">
	    	
		    <div class="col-xs-12">
		    	<div class="col-lg-6">
		    		{!! Form::label('email', 'E-Mail :') !!}
		    		{!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'E-mail']) !!}
		    	</div>
			    <div class="col-xs-3">
			    	{!! Form::label('admin', 'Role :') !!}
			    	{!! Form::select('admin', $Roleids, null, ['class'=>'form-control']) !!}
			    </div>
		    </div>
	    </div>
	</div>
</div>

<button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span>Add</button>
{!! Form::close() !!}
@stop