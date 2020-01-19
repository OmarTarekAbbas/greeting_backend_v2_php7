@if(count($Snapdata)>0)
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

@foreach($Snapdata as $key => $img)



<div class="col-xs-12 Rdata">
    <div class="inner_category">
        <a href="#" data-type="<?= $img->rbt_id ? 1 : 0 ?>" data-link="{{$img->snap_link}}" data-img_src="{{ url($img->path)}}"  data-toggle="modal" data-target="#myModal" class="main_inner snap_info">
            <img src="{{ url('assets/front/newdesign')}}/img/frame.png">

            <div class="view">
                    <i id="eye" eye-val="{{$img->popular_count}}" class="fas fa-eye"></i> <span> {{$img->popular_count}}</span>
                  </div>

            <div class="title_photo_inner">
                <img src="{{ url($img->path)}}">
                <a   href="{{url('viewSnap2/'.$img->id.'/'.$url->UID)}}" >
                    <p  style="color:#000 !important;" >{{$img->getTranslation('title',getCode())}}   </p>
                </a>
            </div>
            @if($img->rbt_id)
            <a  class="icon"  href="sms:{{$rbt_sms}}<?php echo $Att; ?>{{$codes[$key]}}" style="display:none;"></a>
            @endif
        </a>
    </div>
</div>
@endforeach
<!-- =============================== -->
@endif
