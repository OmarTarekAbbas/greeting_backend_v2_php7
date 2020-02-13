@extends('landing_v2.template')
@section('section')
  <div class="confirm_page">
      <img src="{{ url('assets/front/landing_v2')}}/img/logo.png" alt="snap">

      <div class="container">
          <div class="confirm">

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
              <h2>لتاكيد الاشتراك</h2>
              <hr>
              <span>سوف يتم خصم</span>
              <span>١٠٠ فلس يوميا</span>
              <span>نظير الاشتراك في خدمة <br>فلاتر سناب شات</span>

              <form class="form" id="zain_kuwait"  method="post" action="subscribeZainConfirm_without_pinflow">
                  <input type="hidden"  name="number" value="{{$msisdn}}">
                  {{ csrf_field() }}

                  <button type="submit" class="btn" >   استمرار</button>
              </form>


              <p>عند الضغط على استمرار سيتم الاشتراك فى خدمة <br>فلاتر سناب شات</p>
          </div>
      </div>
  </div>

@stop


<!--=======================================================start  Modal ===================================================================-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">خدمة فلاتر سناب شات</h4>
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
<!--=======================================================End Modal ===================================================================-->
