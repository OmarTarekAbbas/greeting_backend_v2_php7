<!--==================================== -->
@extends('front.newdesign.template')
@section('content')
<?php
$title = "";
preg_match("/iPhone|iPad|iPod/", $_SERVER['HTTP_USER_AGENT'], $matches);
$os = current($matches);

switch ($os) {
    case 'iPhone':
        if (preg_match('/OS 8/', $_SERVER['HTTP_USER_AGENT']) || preg_match('/OS 9/', $_SERVER['HTTP_USER_AGENT'])) {
            $Att = '&body=';
        } else {
            $Att = ';';
        }
        break;
    case 'iPad': $Att = '&body=';
        break;
    case 'iPod': $Att = '&body=';
        break;
    default : $Att = '?body=';
        break;
}
?>
@if($snap)
<!-- ==================================== -->


<style type="text/css">
    .inner_category .view {
    position: absolute;
    left: 45px;
    bottom: 52px;
    color: #f23c57;
}

.category:nth-child(even) .view {
    position: absolute;
    left: 115px;
    bottom: 45px;
    color: #f23c57;
}
</style>


<div class="main">
    <div class="container">
        <div class="row" id="categoryStatus" action="inactive">
            <!-- =============================== -->
            <div class="col-xs-12 Rdata">
                <div class="inner_category inner daily_failter">
                    <h4>فلتر اليوم</h4>

                    <a href="#" data-type="<?= $snap->rbt_id ? 1 : 0 ?>" data-link="{{$snap->snap_link}}"  data-img_src="{{ url($snap->path)}}"  data-toggle="modal" data-target="#myModal" class="main_inner snap_info">
                        <img src="{{ url('assets/front/newdesign')}}/img/frame.png">

                        <div class="view">
                            <i id="eye" eye-val="{{$snap->popular_count}}" class="fas fa-eye"></i> <span> {{$snap->popular_count}}</span>
                        </div>
                        <div class="view" style="top: 59%;right: 22%;font-size: 28px;">
                            <i id="eye" data-id="{{$snap->id}}" class="fas fa-thumbs-up ajax_call"></i>
                        </div>

                        <div class="title_photo_inner">
                            <img c src="{{ url($snap->path)}}">
                            <p >{{$snap->title}}</p>
                        </div>
                        @if($snap->rbt_id)
                        <a class="icon"   href="sms:{{$rbt_sms}}<?php echo $Att; ?>{{$code}}" style="display:none;"></a>
                        @endif
                    </a>
                </div>
            </div>
            <!-- =============================== -->



            <div class="main_category cat">

                <h4>التصنيفات</h4>

                <?php $snap_Occasions = snap_Occasions();$i=0 ?>
                @foreach($snap_Occasions as $key=> $value)
                <div class="category">
                    <a href="{{url('listSnap/'.$value->id .'/'.UID())}}" class="main_inner">
                        <img src="{{ url('assets/front/newdesign')}}/img/frame.png">

                        <!-- <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> 20</span>
                  </div> -->

                        <div class="title_photo">
                            <img class="{{($i%2 == 0)?'left':'right'}}" src="{{  url($value->image) }}">
                            <p class="{{($i%2 == 0)?'left_text':'right_text'}}">{{$value->title}}</p>
                        </div>
                    </a>
                </div>
                <?php $i++; ?>
                @endforeach
            </div>



        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade main_snap_modal" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <img id="img" src="">
                <h5 class="modal-title" id="exampleModalLabel"></h5>

                <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> 20</span>
                </div>

                <div class="view" style="/* background-color: transparent; */top: 3%;left: 21px;font-size: 25px;height: auto;width: fit-content;">
                    <i id="eye" data-id="{{$snap->id}}" class="fas fa-thumbs-up ajax_call"></i>
                </div>

            </div>
            <div class="modal-body snap-modal">
                <a class="snap_button" id="link" href="">استخدم العدسة</a>

                <a class="snap_button cart" id="cart"  href="">اشترى النغمة</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-snap" data-dismiss="modal">الغاء الامر</button>
            </div>
        </div>

    </div>
</div>


<div class="load" style="position: fixed;top: 40%;left:40%"><img src="{{url('img/loading.gif')}}" width="10%"/></div>


<!-- ==================================== -->
@endif
@stop
<!-- ==================================== -->
@section('script')
<script>
    $('.load').hide();
    $(document).on("click", ".snap_info", function () {

        //  var img = $(this).parent().find('.title_photo_inner img').attr('src');
        var img = $(this).attr('data-img_src');
        console.log(img);
        var link = $(this).attr('data-link');
        var type = $(this).attr('data-type');
        var eye = $(this).parent().parent().find('.view #eye').attr('eye-val');
        console.log(eye);
        $('#myModal .view #eye').next('span').html(eye);
        if (type == 1) {
            var sms = $(this).parent().find('.icon').attr('href');
            $('#myModal #cart').attr('href', sms);
            $('#myModal .cart').show();
        }
        else {
            $('#myModal .cart').hide();
        }
        $('#myModal #img').attr('src', img);
        $('#myModal #link').attr('href', link);
    });

    $(document).on('click','.ajax_call',function(){
        if($(this).hasClass('fa-thumbs-up')){ 
            var str = '?id='+$(this).data('id')+'&type=1'
            $.get('{{url("like_dislike/".UID())}}'+str,function(response){
                $('.ajax_call').removeClass('fa-thumbs-up').addClass('fa-thumbs-down')
            })
        }
        else{
            var str = '?id='+$(this).data('id')+'&type=2'
            $.get('{{url("like_dislike/".UID())}}'+str,function(response){
                $('.ajax_call').removeClass('fa-thumbs-down').addClass('fa-thumbs-up')
            })
        }
    })


</script>
@stop
