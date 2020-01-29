@extends('front.newdesign.template')
@section('content')

<!--=========== content start =================== -->
<div class="main" style="padding-top: 10%">
   <div class="container">
        <div class="table">          
          <table class="table">
            <tbody>
              <tr>
                <td>رقم الهاتف</td>
                <td>{{Session::get('MSISDN')}}</td>
              </tr>
              <tr>
                <td>الشبكة</td>
                <td>viva</td>
              </tr>
              <tr>
                <td>تاريخ الاشتراك</td>
                <td>{{$msisden->subscribe_date}}</td>
              </tr>
              <tr>
                <td>تاريخ التجديد</td>
                <td>{{$msisden->renew_date}}</td>
              </tr>
              <tr>
                <td>اسم الخدمة</td>
                <td>فلاتر</td>
              </tr>
              <tr>
                <td>نوع الخدمة</td>
                <td>يومية</td>
              </tr>
            </tbody>
          </table>

          <a href="{{url('link2/snapCategory/'.UID())}}" class="btn">الرئيسية</a>
          <!-- <a href="" class="btn">الغاء</a> -->

      </div>
   </div>
</div>
<!--=========== content end =================== -->
@stop
