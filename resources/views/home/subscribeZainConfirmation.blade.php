@extends('home/home_template')

@section('ar_css')
    <link rel="stylesheet" type="text/css" href="{{url('home/css/bootstrap-ar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('home/css/thanks.css')}}">
@stop


@section('content')

    <div class="container">
        <div class="row">
            <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="row">



                    <div class="text-center">
                        <h1> مشاري بن راشد العفاسي </h1>
                    </div>
                    </span>
                    <table class="table table-hover" align="text-center">
                        <tbody>
                        <tr>
                            <td class="text-center">

                                <br><br> <span>مشاري بن راشد العفاسي لكفالة الايتام</span>
                                <br><br>  <p> رقم الجوال
                                    <span> {{$msisdn}} </span>

{{--
                                    <br><br> <span> 100 فلس يوميا </span>
--}}
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <form class="form" id="zain_kuwait"  method="post" action="subscribeZainConfirm">
                        {{ csrf_field() }}
                        <input  type="hidden" name="number" value="{{$msisdn}}">
                    </form>




                    <!--=======================================================start  Modal ===================================================================-->
                    <div class="modal fade" id="myModal" role="dialog">
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




                    <br>

                </div>
            </div>
        </div>
    </div>