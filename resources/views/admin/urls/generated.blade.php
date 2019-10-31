@extends('admin.master')
@section('title')
    Generated URLs
@endsection
@section('PageTitle')
    Generated URLs
@endsection
@section('PageDesc')
    Generated URL
@endsection
@section('breadcrumb')
    <li class="active">Generated URL</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="form-group">
                    @if($snap> 0)
                    <span class="text text-info">link 1 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="{{ url('snap/'.$UID) }}" />
                    <span class="text text-info">link 2 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="{{ url('cuurentSnap/'.$UID) }}" />
                    <span class="text text-info">link 3 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="{{ url('cuurentSnap_v2/'.$UID) }}" />
                    @else
                    <input type="text" name="generatedurl" class="form-control input-lg" value="{{ url($UID) }}" />
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <span class="divider"></span>
    </div>


@endsection
