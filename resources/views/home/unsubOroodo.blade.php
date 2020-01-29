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
                    <h1> لتأكيد الغاء الاشتراك </h1>
                </div>
                <!--====================================================sart table==================================================-->
                <table class="table table-hover" align="text-center">
                    <tbody>
                    <tr>
                        <td class="text-center">
                            <p>الرجاء ادخال رقم الجوال</p>
                            <!--=============End form================-->
                            <form  method="post"  action="unsubscribeOoredoo" >
                                {{ csrf_field() }}
                                <div id=input class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input id="number" type="number" class="form-control" name="number" placeholder="ادخل رقم الجوال"  required>
                                    <span class="input-group-addon"><i> +965 </i></span>
                                </div>
                                <br><br><br>
                                <button type="submit" class="btn btn-success btn-lg btn-block" >الغاء الاشتراك</button>
                            </form>
                        </td>
                    </tr>
                    <!--=============End form================-->
                    </tbody>
                </table>
                <!--====================================================End table==================================================-->
                <!--=======================================================start  Modal ===================================================================-->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">خدمة مشاري بن راشد العفاسي لكفالة الايتام</h4>
                            </div>
                            <div class="modal-body">
                                <p>تم الغاء الخدمه</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success " data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--======================================================= End Modal ===================================================================-->
                <br>
                <div class="cont">
                    <p class="text-center">سيتم الغاء الخدمه عند الضغط علي زر الغاء الاشتراك</p>
                </div>
            </div>
        </div>
    </div>
</div>

