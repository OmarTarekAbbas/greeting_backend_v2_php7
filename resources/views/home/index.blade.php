@extends('home/home_template')


@section('main_css')
    <link rel="stylesheet" type="text/css" href="{{url('home/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css"  href="{{url('home/css/animate.css')}}" >
    <link rel="stylesheet" type="text/css"  href="{{url('home/css/style.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{url('home/css/media_query.css')}}">
@stop


@section('content')

<!--========================================================== Loading ================================================-->
<div id="loading">
<div id="loading-center">
<div id="loading-center-absolute">
<div class="object" id="object_one"></div>
<div class="object" id="object_two"></div>
<div class="object" id="object_three"></div>
<div class="object" id="object_four"></div>
</div>
</div>
</div>
<!--========================================================== Loading ================================================-->

     <div class="container-fluid">
     <div class="col-xs-12 col-sm-6">

     <div class="logomshary wow fadeInDown"  data-wow-duration="3000ms" data-wow-offset="100" data-wow-delay="1.5s">
       <img src="img/final.png" alt="mshary_Logo">
     </div>

<div class="hadees wow fadeInLeft"  data-wow-duration="3000ms" data-wow-offset="100" data-wow-delay="1.5s">
  <h2>قال رسول الله ﷺ</h2>
  <p class="lead">أَتَحَبُّ أَنْ يَلِيَنَّ قُلَّبُكَ وَتُدَرِّكَ حَاجَتُكَ ؟ <br>اِرْحَمْ الْيَتِيمَ، وَاِمْسَحْ رَأْسَهُ وَأَطْعَمَهُ مِنْ طعَامِكَ يُلَنْ قُلَّبُكَ وَتُدَرِّكُ حَاجَتْك</p>
</div> 
<!--=======================================================  End-hadeess ======================================================-->
<div class="ssub wow fadeInRight"  data-wow-duration="3000ms" data-wow-offset="100" data-wow-delay="1.5s">
  <h2>اشــترك فــي خدمه الشيخ مشاري راشد العفاسي <br> وكن من المساهمين في كفاله الايتام</h2>
</div> 



<!--=======================================================  End-mshary logo    ======================================================-->
<div class="clearfix"></div>
<!--=======================================================  start-operator  ======================================================-->
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
      
    <div id="changeOP" class="changeOP">
    </div>
    <div id="orze" class="main">

            <img id='oredo'   onclick="showOperatorForm('oreedo')"   class=" hvr-grow oredo  wow pulse operator_name"  data-wow-iteration="infinite" data-wow-duration="2000ms" src="{{url('home/img/Ooredoo1.png')}}" alt="oredo" >
            <img id='zain' onclick="showOperatorForm('zain')"  class=" hvr-grow zain  wow pulse operator_name"  data-wow-iteration="infinite" data-wow-duration="2000ms"  src="{{url('home/img/zain.png')}}" alt="zain" >
             <img id='viva'    onclick="showOperatorForm('viva')"    class=" hvr-grow oredo  wow pulse operator_name"  data-wow-iteration="infinite" data-wow-duration="2000ms" src="{{url('home/img/viva.png')}}" alt="viva" >


    </div>
    <div  class="changeOP">
    </div>


    <!--=============================== End-opreting ================================-->
    <div class="clearfix"></div>
    <!--=======================> cleaefix-->


         <form class="form" id=zain_kuwait method="post" action="subscribeZain">
        {{ csrf_field() }}
        <div id=input class="input-group">
            <span class="input-group-addon"><i> +965 </i></span>
            <input id="number" min="1" type="number" class="form-control" name="number" value="{{$MSISDN}}"    placeholder="ادخل رقم الجوال" required>
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="hidden"  value="zain_kuwait" name="operator_name">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success btn-lg ">  اشترك</button>
            </div>
        </div>
    </form>







    <form class="form" id=oreedo_kuwait method="post" action="subscribeOreedo">
        {{ csrf_field() }}
        <div id=input class="input-group">
            <span class="input-group-addon"><i> +965 </i></span>
            <input id="number"  min="1" type="number" class="form-control" name="number" value="{{$MSISDN}}"   placeholder="ادخل رقم الجوال" required>
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="hidden" value="oreedo_kuwait" name="operator_name">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success btn-lg "> اشترك</button>
            </div>
        </div>
    </form>


         <form class="form" id=viva_kuwait method="post" action="subscribeViva">
             {{ csrf_field() }}
             <div id=input class="input-group">
                 <span class="input-group-addon"><i> +965 </i></span>
                 <input id="number"  min="1" type="number" class="form-control" name="number" value="{{$MSISDN}}"   placeholder="ادخل رقم الجوال" required>
                 <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                 <input type="hidden" value="oreedo_kuwait" name="operator_name">
             </div>
             <div class="form-group">
                 <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-success btn-lg "> اشترك</button>
                 </div>
             </div>
         </form>





    <!--===============================End oredo Form ================================-->
    <div class="clearfix">  </div>
    <!--=======================> cleaefix-->
    <!--=============================== Start-Term================================-->
     <div id="tarm" class="tarm wow fadeInUp"  data-wow-duration="3000ms" data-wow-offset="100" data-wow-delay="1.5s" >
      {{--  <p class="lead"> لايقاف الخدمه علي شبكه زين ارسل غ الي رقم 97779 او اضغط علي <span><a href="{{url('unsubZain')}}"> الغاء الاشتراك</a></span><br></p>
        <p class="lead" style="direction: rtl;"   > لايقاف الخدمه علي شبكه اوريدو ارسل STOP الي رقم 1940 او اضغط علي <span><a href="{{url('unsubOroodo')}}"> الغاء الاشتراك</a></span><br></p>
         <p class="lead" style="direction: rtl;"   > لايقاف الخدمه علي شبكه فيفا ارسل الغاء  1   الي رقم 50770 او اضغط علي <span><a href="{{url('unsubOroodo')}}"> الغاء الاشتراك</a></span><br></p>
--}}


         <p class="lead"> لايقاف الخدمه علي شبكه زين ارسل غ الي رقم 97779  <span></span><br></p>
         <p class="lead" style="direction: rtl;"   > لايقاف الخدمه علي شبكه اوريدو ارسل STOP الي رقم 1940  <span></span><br></p>
         <p class="lead" style="direction: rtl;"   > لايقاف الخدمه علي شبكه فيفا ارسل الغاء  1   الي رقم 50770  <br></p>

         <p class="lead"> لاستخدام الخدمة يجب أن تكون فوق 18 سنة أو حصلت على موافقة الاهل أو الشخص المخول لدفع فاتورة جوالك</p>
    </div>






    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">خدمة مشاري بن راشد العفاسي لكفالة الايتام</h4>
                </div>
                <div class="modal-body">
                    <p>{{Session::get('error')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
</div>




         <div class="modal fade" id="myModal_zain_subscribe-result" role="dialog">
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


<div class="col-xs-0 col-sm-6"></div>
</div>


@stop






