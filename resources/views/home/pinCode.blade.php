@extends('home/home_template')

@section('ar_css')
    <link rel="stylesheet" type="text/css" href="{{url('home/css/bootstrap-ar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('home/css/thanks.css')}}">
@stop


@section('content')



    <div class="container">

    <div class="row">

        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('success')}}
                </div>
            @elseif(Session::has('failed'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('failed')}}
                </div>
            @endif

            <div class="row">
                <div class="text-center">
                    <h1> ادخل كود التفعيل </h1>
                </div>
                </span>


               {{-- <form class="form" id="zain_kuwait"  method="post" action="subscribeZainPincodeConfirm">--}}
                    {!! Form::open(['url'=>'subscribeZainPincodeConfirm','method'=>'post','class'=>'form','files'=>'true']) !!}

                    <table class="table table-hover" align="text-center">
                        <tbody>
                        <tr>
                            <td class="text-center">
                                {{--  <p class="error_message">الكود الذي ادخلته خطا يرجع اعاده الكود !!</p>--}}
                                <input type="number" name="pincode"   class="form-control" id="pincode" required>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <input type="hidden"  name="msisdn" value="{{$msisdn}}">


                <button type="submit" class="btn btn-success btn-lg btn-block" > تاكيد</button>

            {!! Form::close() !!}





            
<!--                 <div class="cont">
                    <p class="text-center">عند الضغط علي استمرار سيتم الاشتراك في خدمه مشاري بن راشد العفاسي لكفالة الايتام</p>
                </div> -->
            </div>
        </div>
    </div>
    </div>