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
<style>
    .form-control, .wysihtml5-sandbox{
        width: 50%;
    }
    .btn.btn-info{
        float: right;
        margin-top: -2%;
        margin-right: 46%;
    }
</style>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="form-group">
                    @if($snap> 0)
                    <span class="text text-info">link 1 : </span>
                        <input type="text" name="generatedurl" class="form-control input-lg" value="{{ url('snap/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <span class="text text-info">link 2 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="{{ url('cuurentSnap/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <span class="text text-info">link 3 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="{{ url('cuurentSnap_v2/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <span class="text text-info">link 4 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="{{ url('newdesignv4/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <span class="text text-info">rotana : </span><input type="text" name="generatedurl" class="form-control input-lg" value="{{ url('rotana/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <span class="text text-info">Mbc : </span><input type="text" name="generatedurl" class="form-control input-lg" value="{{ url('mbc/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
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
@section('script')
    <script>
        $(document).ready(function () {
            $(".copy").click(function () {
                var copyText = $(this).prev('input');
                console.log(copyText.attr('class'));
                copyText.select();
                document.execCommand("copy");
                //alert("Copied the text: " + copyText.val());
            });
        })
    </script>
@stop
