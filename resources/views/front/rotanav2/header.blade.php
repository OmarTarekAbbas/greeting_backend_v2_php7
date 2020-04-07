<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotana</title>
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/style.css')}}">
    <base target="_parent">
</head>

<body>
  <main class="new_rotana">
    <header class="header_head w-100">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="header_logo">
              <a href="{{url('/rotanav2/'.uid())}}">
                <img class="d-block m-auto slide-in-fwd-bottom" src="{{url('assets/front/rotanav2/images/new_rotana.png')}}" alt="Rotana Logo">
              </a>
              @if(getCode() == 'ar')
              <a style="color:#fff" href="{{url('admin/lang/en')}}">En</a>
              @else
              <a style="color:#fff" href="{{url('admin/lang/ar')}}">Ar</a>
              @endif
            </div>
        </header>
