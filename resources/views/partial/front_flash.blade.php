<br><br>
		@if(Session::has('success'))
			<div class="alert alert-success {{Session::has('important_msg') ? 'alert-important' : '' }}" style="text-align:right;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="float: left;" >&times;</button>
				{{Session::get('success')}}
			</div>
		@elseif(Session::has('failed'))
			<div class="alert alert-danger" style="text-align:right;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="float: left;" >&times;</button>
				{{Session::get('failed')}}
			</div>
		@endif