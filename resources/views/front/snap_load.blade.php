
@if($Snapdata)
<?php
$title = "snaps";
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
    <!-- Audio -->
    <li data-type="<?= $img->rbt_id ? 1 : 0 ?>" class="snap occasion_{{$img->occasion_id}}" >
        <!--        @if($img->rbt_id)
                <img class="star" src="../img/Gold_star.png" alt="star">
                 @endif-->
        <a class="sound_icon snap_info"   data-toggle="modal" data-target="#exampleModal"  href="{{$img->snap_link}}"> <img src="{{url("$img->path")}}"></a>
        <a class="title_sound snap_info" data-toggle="modal" data-target="#exampleModal" href="#">{{$img->title}} </a>
        @if($img->rbt_id)
        <a class="icon"  href="sms:{{$rbt_sms}}<?php echo $Att; ?>{{$codes[$key]}}"><i class="fas fa-cart-plus"></i></a>
        <div class="np-play play-status">
            <span class="fa fa-play" data-src="{{url($img->Rbt->path)}}"></span>
        </div>
        <a href='#' class="cf arabic"></a>
        @endif

         <div class="view">
            <i id="eye" eye-val="{{$img->popular_count}}" class="fas fa-eye"></i> <span> {{$img->popular_count}}</span>
         </div>
    </li>
    @endforeach
@endif
