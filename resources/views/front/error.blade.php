<?php  $title = "خطأ";?>
@extends('front.template')
@section('content')
  
   <style type="text/css">
   header {
    display: none !important;    
   }
   a{font-family: 'Cairo', sans-serif;}
   </style>
<!-- ========================================================================= -->
  


<div class="error-page">
  <div>

    <h1 data-h1="404">404</h1>
    <p data-p="NOT FOUND">NOT FOUND</p>
    @if(ValidUID()==1)
    <a class="btn-link error_btn" href="{{url(UID())}}">الصفحه الرئيسيه</a>
    @endif
  </div>
</div>



@stop



