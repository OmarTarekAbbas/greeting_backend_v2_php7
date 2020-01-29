<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <title>Login to Greeting Panel</title>
    @include('head')
</head>

<body class="auth-page height-auto bg-blue-600">
    <!-- BEGIN CONTENT -->
    <div class="wrapper animated fadeInDown">

        <div class="panel overflow-hidden">
            <div
                class="bg-light-blue-500 padding-top-25 no-margin-bottom font-size-20 color-white text-center text-uppercase">
                <i class="ion-log-in margin-right-5"></i> Sign In to Greeting Panel
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group row">
                                    <div class="col-md-6">
                                             
                                        </div>
                                        <div class="col-md-6">
                                        <div class="card-header"><h4>{{ __('Reset Password') }}</h1></div>

                                                <input type="email" class="form-control input-lg form-control @error('email') is-invalid @enderror" placeholder="E-Mail" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus />

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color: red;">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-12">
                                           
                                        </div>
                                        <div class="col-md-6 offset-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{ asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/plugins/bootstrap/js/holder.js') }}"></script>
            <script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript">
            </script>
            <script src="{{ asset('assets/js/core.js') }}" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->

            <!-- bootstrap validator -->
            <script src="{{ asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}"
                type="text/javascript"></script>

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
