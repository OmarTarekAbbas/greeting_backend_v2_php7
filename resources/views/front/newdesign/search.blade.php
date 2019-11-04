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
        case 'iPad':
            $Att = '&body=';
            break;
        case 'iPod':
            $Att = '&body=';
            break;
        default :
            $Att = '?body=';
            break;
    }
    ?>
        <!-- ==================================== -->

        <style type="text/css">
            .title_photo_inner p {
                position: absolute;
                top: 45%;
                width: 50%;
                text-align: center;
                transform: translate(-50%, -50%);
                right: 1%;
                color: #111;
                font-weight: 800;
            }

            .title_photo_inner img {
                width: 75px;
                top: 45%;
                height: 75px;
                position: absolute;
                transform: translate(-50%, -50%);
                border: 2px solid red;
                right: 2% !important;
                border-radius: 50%;
            }
        </style>

        <div class="main">
            <div class="container" style="min-height: 900px">
                @if(count($Rdata) > 0)
                <div class="main_category cat">
                    <div class="row" id="categoryStatus" action="inactive">
                        <!-- =============================== -->
                    @foreach($Rdata as $key => $img)
                        <!-- <div class="col-xs-2"><button class="copy_btn"><i class="fas fa-copy fa-lg"></i></button><input type="text" value="{{url(url('viewSnap2/'.$img->id.'/'.UID()))}}" /> </div> -->
                            <div class="col-xs-12 Rdata">
                                <div class="inner_category">
                                    <a href="#" data-type="<?= $img->rbt_id ? 1 : 0 ?>" data-link="{{$img->snap_link}}"
                                       data-img_src="{{ url($img->path)}}" data-toggle="modal" data-target="#myModal"
                                       class="main_inner snap_info">
                                        <img src="{{ url('assets/front/newdesign')}}/img/frame.png">

                                        <div class="view">
                                            <i id="eye" eye-val="{{$img->popular_count}}" class="fas fa-eye"></i>
                                            <span> {{$img->popular_count}}</span>
                                        </div>

                                        <div class="title_photo_inner">
                                            <img src="{{ url($img->path)}}">

                                            <a href="{{url('viewSnap2/'.$img->id.'/'.UID())}}">
                                                <p style="color:#000 !important;">{{$img->title}}   </p>
                                            </a>

                                        </div>
                                        @if($img->rbt_id)
                                            <a class="icon" href="sms:{{$rbt_sms}}<?php echo $Att; ?>{{$codes[$key]}}"
                                               style="display:none;"></a>
                                        @endif
                                    </a>
                                </div>
                            </div>
                    @endforeach
                    <!-- =============================== -->
                    </div>
                </div>
                @endif
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

                        </div>
                        <div class="modal-body snap-modal">
                            <a class="snap_button" id="link" href="">استخدم العدسة</a>

                            <a class="snap_button cart" id="cart" href="">اشترى النغمة</a>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-snap" data-dismiss="modal">الغاء الامر</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="load" style="position: fixed;top: 40%;left:40%"><img src="{{url('img/loading.gif')}}"
                                                                             width="10%"/></div>


            <!-- ==================================== -->

        @stop
        <!-- ==================================== -->
        @section('script')

                <script>
                    search_key = "{{$search}}"
                    $('.load').hide();
                    $(document).on("click", ".snap_info", function () {
                        var link = $(this).attr('data-link');
                        var type = $(this).attr('data-type');
                        var img = $(this).attr('data-img_src');
                        var eye = $(this).parent().parent().find('.view #eye').attr('eye-val');
                        console.log(eye);
                        $('#myModal .view #eye').next('span').html(eye);
                        if (type == 1) {

                            var sms = $(this).parent().find('.icon').attr('href');
                            $('#myModal #cart').attr('href', sms);

                            $('#myModal .cart').show();
                        } else {
                            $('#myModal .cart').hide();
                        }
                        $('#myModal #img').attr('src', img);
                        $('#myModal #link').attr('href', link);
                    });
                    // load more
                    $(window).on("scroll", function () {
                        var action = $('#categoryStatus').attr('action');
                        if ($(window).scrollTop() + $(window).height() > $("#categoryStatus").height() && action == 'inactive') {
                            $('#categoryStatus').attr('action', 'active');
                            var start = $('#categoryStatus .Rdata').length
                           
                            load_snap_data(start);
                        }
                    });

                    function load_snap_data(start) {
                        $('.load').show();
                        $.ajax({
                            type: 'GET',
                            url: "{{url('loadMoreSnapNew')}}" + "?start=" + start + "&search=" + search_key + "&UID=" + {{UID()}},
                            success: function (data) {
                                if (data.html == '') {
                                    $('#categoryStatus').attr('action', 'active');
                                } else {
                                    $('#categoryStatus').append(data.html);
                                    $('#categoryStatus').attr('action', 'inactive');
                                }
                                $('.load').hide();
                            }
                        })
                    }


                    // copy btn

                    $(document).on("click", ".copy_btn", function () {
                        $(this).next().select();
                        document.execCommand("copy");
                    });


                </script>
@stop
