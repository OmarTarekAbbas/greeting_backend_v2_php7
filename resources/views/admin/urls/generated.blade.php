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
                    <span class="text text-info">link 1 : </span><input type="text" name="generatedurl" class="" value="{{ url('snap/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <hr>
                    <span class="text text-info">link 2 : </span><input type="text" name="generatedurl" class="" value="{{ url('cuurentSnap/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <hr>
                    
                    <span class="text text-info">link 3 : </span><input type="text" name="generatedurl" class="" value="{{ url('cuurentSnap_v2/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <hr>
                    
                    <span class="text text-info">link 4 : </span><input type="text" name="generatedurl" class="" value="{{ url('newdesignv4/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <hr>
                    
                    <span class="text text-info">rotana : </span><input type="text" name="generatedurl" class="" value="{{ url('rotana/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <hr>
                    
                    <span class="text text-info">Mbc : </span><input type="text" name="generatedurl" class="" value="{{ url('mbc/'.$UID) }}" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <hr>
                  
                    @else
                    <input type="text" name="generatedurl" class="" value="{{ url($UID) }}" />
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
