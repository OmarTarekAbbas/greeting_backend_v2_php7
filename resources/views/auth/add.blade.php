<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <title>Register New Account</title>
    @include('head')
</head>
<body class="auth-page height-auto bg-teal-600">
<!-- BEGIN CONTENT -->
<div class="wrapper animated fadeInDown">
    <div class="panel overflow-hidden">
        <div class="bg-teal-500 padding-top-25 no-padding-bottom font-size-20 color-white text-center text-uppercase">
            <i class="ion-person-add margin-right-5"></i> Create a new account
        </div>
        <form id="checkform" role="form" method="POST" action="{{ url('/admin/user') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="alert bg-teal-500 text-center color-white no-radius no-margin padding-top-15 padding-bottom-30 padding-left-20 padding-right-20">create your own private account by one click</div>
            <div class="box-body padding-md">
                <div class="row">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group col-lg-12">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control input-lg" placeholder="Full Name" required="required" value="{{ old('name') }}"/>
                    </div>

                </div>

                <div class="form-group col-lg-12">
                    <label for="email" class="control-label">E-Mail</label>

                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="E-Mail" required="required" value="{{ old('email') }}"/>

                </div>

                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password"/>
                </div>

                <div class="form-group">
                    <label for="repeat-password" class="control-label">Repeat Password</label>
                    <input type="password" name="password_confirmation" id="repeat-password" class="form-control input-lg" placeholder="Password"/>
                </div>


                <button type="submit" class="btn btn-dark bg-green-500 padding-10 btn-block color-white">create account</button>
            </div>
        </form>
        <div class="panel-footer padding-md no-margin no-border bg-teal-500 text-center color-white">&copy; <?php  echo date("Y") ?> IVAS.</div>
    </div>
</div>
<!-- END CONTENT -->