@extends('front_v2.app')
@section('page_title') Profile @endsection
@section('content')
<br><br>
<main class="list_categories close_nav mt-3">
  <div class="container">
    <div class="col-12">
      <div class="main_head_title">
        <a href="#0">
          <h2 class="text-center text-white h3">Profile</h2>
        </a>
      </div>
    </div>
    <br>
    <div class="table-responsive">
      <table class="table table-bordered">
        <tbody style="color:#2e2e">
          <tr>
            <td>رقم الهاتف</td>
            <td>{{preg_replace('/^965/', '', $msisdn->phone_number)}}</td>
          </tr>
          <tr>
            <td>الشبكة</td>
            <td>viva</td>
          </tr>
          <tr>
            <td>تاريخ الاشتراك</td>
            <td>{{$msisdn->subscribe_date}}</td>
          </tr>
          <tr>
            <td>تاريخ التجديد</td>
            <td>{{$msisdn->renew_date}}</td>
          </tr>
          <tr>
            <td>اسم الخدمة</td>
            <td>بطاقات التهنئة</td>
          </tr>
          <tr>
            <td>نوع الخدمة</td>
            <td>يومية</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </div>
@stop
