<!-- ==================================== -->
@extends('front.newdesign.template')
@section('content')
<!-- ==================================== -->
<!--=========== content start =================== -->
@if(count($Rdata)>0)


<style type="text/css">
    .title_photo img {
    width: 70px;
    height: 70px;
    top: 44%;
    position: absolute;
    transform: translate(-50%, -50%);
    border: 2px solid red;
    border-radius: 50%;
}

.main_category .left {
    left: 70%;
}

.main_category .right_text {
    top: 45% !important;
    right: -8% !important;
}

.category:nth-child(even) .view {
    position: absolute;
    left: 123px;
    bottom: 45px;
    color: #f23c57;
}

.main_category .title_photo p {
    position: absolute;
    top: 45%;
    width: 50%;
    text-align: center;
    transform: translate(-50%, -50%);
    right: 14%;
    color: #111;
    font-weight: 800;
}
</style>


<div class="main">
      <div class="main_category">
          @foreach($occasions as $key => $value)          
            <div class="category">
               <a href="{{url('listSnap/'.$value->id .'/'.UID())}}" class="main_inner">
                  <img src="{{ url('assets/front/newdesign')}}/img/frame.png"> 

                  <!-- <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> 20</span>
                  </div> -->

                  <div class="title_photo">
                     <img class="{{($key%2 == 0)?'left':'right'}}" src="{{  url($value->image) }}">
                     <p class="{{($key%2 == 0)?'left_text':'right_text'}}">{{$value->title}}</p>
                  </div>
               </a>
            </div>
          @endforeach         
      </div>
</div>
@endif
@stop