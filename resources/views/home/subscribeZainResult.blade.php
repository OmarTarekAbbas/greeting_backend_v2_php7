@extends('home/home_template')

@section('ar_css')
    <link rel="stylesheet" type="text/css" href="{{url('home/css/bootstrap-ar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('home/css/sub.css')}}">
@stop


@section('content')


    <div class="container">
        <div class="row">
            <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="row">
                    <div class="text-center">
                        <h1>مشاري راشد لكفاله الايتام </h1>
                    </div>
                    </span>
                    <table class="table table-hover" align="text-center">
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <h2>{{ $result }} </h2>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!--=======================================================End Modal ===================================================================-->
                    <br>
                    @if($action == "1" || $action == "3")
                    <div class="cont">
                        <p class="text-center">للاستمتاع بالمحتوي يرجي الدخول علي هذا الرابط <span><a href="{{$content_link}}"> الرابط</a></span></p>
                    </div>
                        @endif
                </div>
            </div>
        </div>