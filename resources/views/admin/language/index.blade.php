@extends('admin.master')
@section('page_title')
	@lang('messages.languages')
@stop
@section('PageContent')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-black">
				<div class="box-title">
					<h3><i class="fa fa-table"></i>@lang('messages.languages')</h3>
					<div class="box-tool">
						<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
						<a data-action="close" href="#"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="box-content">
					<div class="btn-toolbar pull-right">
						<div class="btn-group">
							<a class="btn btn-circle show-tooltip" title="" href="{{url('admin/language/create')}}" data-original-title="Add new record"><i class="fa fa-plus"></i></a>
							<?php
								$table_name = "languages" ;
								// pass table name to delete all function
								// if the current route exists in delete all table flags it will appear in view
								// else it'll not appear
							?>
						</div>

					</div><br><br>
					<div class="table-responsive">
						<table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
							<thead>
							<tr>
							<th style="width:18px"><input type="checkbox" onclick="select_all('{{$table_name}}')"></th>
								<th>@lang('messages.campain.title')</th>
								<th>@lang('messages.short_code')</th>
								<th>@lang('messages.right_to_list') ?</th>
								<th class="visible-md visible-lg" style="width:130px">@lang('messages.action')</th>
							</tr>
							</thead>
							<tbody>
							@foreach($languages as $language)
								<tr class="table-flag-blue">
								<th><input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{$language->id}}" class="roles" onclick="collect_selected(this)"></th>
									<td>{{$language->title}}</td>
									<td>{{$language->short_code}}</td>
									<td>{!!$language->rtl!!}</td>
									<td class="visible-md visible-lg">
										<div class="btn-group">
											<a class="btn btn-sm show-tooltip" title="" href="{{url('admin/language/'.$language->id.'/edit')}}" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                            {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('LanguageController@destroy', $language->id))) !!}
                                            <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete')">
                                                <i class="fa fa-trash-o "></i>
                                            </button>
                                            {!! Form::close() !!}
										</div>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('script')

	<script>
		$('#language').addClass('active');
		$('#language-index').addClass('active');
	</script>
@stop
