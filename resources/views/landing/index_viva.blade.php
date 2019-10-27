@extends('landing.template_viva')
@section('section')

<style type="text/css">
    

</style>

<div class="landing_page">



    <img class="logo" src="{{ url('assets/front/landing')}}/img/Snapchat-logo2.webp" alt="snap">
    <h6>فلاتر سناب شات</h6>

    <div class="shbka">
        <div class="container">
            <p>اختار شبكتك و اشترك في خدمة فلاتر سناب شات</p>



            <div class="zain_viva">

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
                    <div class="col-12">
                        <img   src="{{ url('assets/front/landing')}}/img/viva.png"  onclick="vivaSub()" id="viva">

                    </div>

<!--                    <div class="col-4">
                        <img  src="{{ url('assets/front/landing')}}/img/Zain.jpg" onclick="showZain()"  id="zain">
                    </div>

                    <div class="col-4">
                        <img   src="{{ url('assets/front/landing')}}/img/ooredoo.png" onclick="showOoredoo()"  id="ooredoo">
                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form_content" id="zain_kuwait_form" style="display:none;">
            <h5>ادخل رقم الهاتف</h5>
            <form class="form" id=zain_kuwait method="post" action="subscribeZain">
                {{ csrf_field() }}
                <div class="form-group form-inline">
                    <label for="phone">965</label>
                    <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}"  >
                    <input type="text" class="form-control" id="phone" placeholder="000-000-00" name="number" required pattern="[0-9]{8}">
                    <span class="validity"></span>
                </div>
                <button class="btn" type="submit">اشترك</button>
            </form>
            <!--            <h5>للاشتراك يرجى الارسال1 الى 50663</h5>
                        <h5>الى 50663<span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
        </div>
    </div>



    <div class="container">
        <div class="form_content" id="ooredoo_kuwait_form" style="display:none;">
            <h5>ادخل رقم الهاتف</h5>
            <form class="form" id=ooredoo_kuwait  method="post" action="subscribeOreedo">
                {{ csrf_field() }}
                <div class="form-group form-inline">
                    <label for="phone">965</label>
                    <input type="hidden"  name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}"  >
                    <input type="text" class="form-control" id="phone" placeholder="000-000-00" name="number" required pattern="[0-9]{8}">
                    <span class="validity"></span>
                </div>
                <button class="btn" type="submit">اشترك</button>
            </form>
            <!--            <h5>للاشتراك يرجى الارسال1 الى 50663</h5>
                        <h5>الى 50663<span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
        </div>
    </div>


    <div class="container">
        <div class="form_content" id="viva_kuwait_form" style="display:none;">
            <h5>ادخل رقم الهاتف</h5>
            <form class="form" id=viva_kuwait  method="post" action="subscribeVivaKuwait">
                {{ csrf_field() }}
                <div class="form-group form-inline">
                    <label for="phone">965</label>
                   <input type="hidden" name="prev_url"  value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}"  >
                   <input type="text" class="form-control" id="phone" placeholder="000-000-00" name="number" required pattern="[0-9]{8}">
                           <span class="validity"></span>
                </div>
                <button class="btn" type="submit">اشترك</button>
            </form>
            <!--            <h5>للاشتراك يرجى الارسال1 الى 50663</h5>
                        <h5>الى 50663<span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
        </div>
    </div>


</div>


@stop


@section('script')

<script type="text/javascript">

    function  vivaSub() {
       
//        $('#ooredoo_kuwait_form').css('display', 'none');
//        $('#zain_kuwait_form').css('display', 'none');
//        $('#viva_kuwait_form').css('display', 'block');
//        $('.shbka').css('display', 'none');
          var viva_url = "http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=964xxxx&ChannelID=4493&ServiceID=221&ImageURL=&CPWEBChannelID=4&INITAction=True"
         window.location.href = viva_url;
    }

    function  showZain() {

        $('#ooredoo_kuwait_form').css('display', 'none');
        $('#viva_kuwait_form').css('display', 'none');
        $('#zain_kuwait_form').css('display', 'block');
        $('.shbka').css('display', 'none');
    }


    function  showOoredoo() {
        $('#zain_kuwait_form').css('display', 'none');
        $('#viva_kuwait_form').css('display', 'none');
        $('#ooredoo_kuwait_form').css('display', 'block');
        $('.shbka').css('display', 'none');
    }
    
    
 $( document ).ready(function() {
     var viva_url = "http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=964xxxx&ChannelID=4493&ServiceID=221&ImageURL=&CPWEBChannelID=4&INITAction=True"
         window.location.href = viva_url;  
});
</script>

@stop



