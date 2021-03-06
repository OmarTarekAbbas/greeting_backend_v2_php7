<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <title>Login to Greeting Panel</title>
    @include('head')
</head>
<body class="auth-page height-auto bg-blue-600">
<!-- BEGIN CONTENT -->
<div class="wrapper animated fadeInDown">

    <div class="panel overflow-hidden">
        <div class="bg-light-blue-500 padding-top-25 no-margin-bottom font-size-20 color-white text-center text-uppercase">
            <i class="ion-log-in margin-right-5"></i> Reset Password form
        </div>


        <form role="form" method="POST" action="{{ url('/password/reset') }}" id="checkform">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="alert bg-light-blue-500 text-center color-white no-radius no-margin padding-top-15 padding-bottom-30 padding-left-20 padding-right-20">Reset Password</div>
            <div class="box-body padding-md">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

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

                <div class="form-group">
                    <input type="email" name="email" class="form-control input-lg" placeholder="E-Mail" value="{{ old('email') }}" />
                </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control input-lg" placeholder="New Password"/>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control input-lg" placeholder="New Password confirmation"/>
                    </div>


                <button type="submit" class="btn btn-dark bg-light-green-500 padding-10 btn-block color-white"><i class="ion-android-alert"></i> Reset Password</button>
            </div>
        </form>
        <div class="panel-footer padding-md no-margin no-border bg-light-blue-500 text-center color-white">&copy; 2015 IVAS.</div>
    </div>
</div>
<!-- END CONTENT -->
<!-- BEGIN JAVASCRIPTS -->

<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/holder.js') }}"></script>
<script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- bootstrap validator -->
<script src="{{ asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}" type="text/javascript"></script>

<!-- switchery -->
<script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}" type="text/javascript"></script>

<!-- maniac -->
<script src="{{ asset('assets/js/maniac.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    maniac.loadvalidator();
    maniac.loadswitchery();
</script>

<!-- END JAVASCRIPTS -->
</body>
</html>