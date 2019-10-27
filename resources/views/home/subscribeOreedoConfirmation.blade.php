@extends('home/home_template')

@section('ar_css')
    <link rel="stylesheet" type="text/css" href="{{url('home/css/bootstrap-ar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('home/css/thanks.css')}}">
@stop


@section('content')


    <div class="container">
    <div class="row">

    </div>
    </div>





    <!--=======================================================start  Modal ===================================================================-->
    <div class="modal fade  myModalOreddoSub" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">خدمة مشاري بن راشد العفاسي لكفالة الايتام</h4>
                </div>
                <div class="modal-body">
                    <p>{{Session::get('message')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <!--=======================================================End Modal ===================================================================-->





