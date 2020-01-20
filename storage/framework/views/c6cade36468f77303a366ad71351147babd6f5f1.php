<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
	<title>Login to Greeting Panel</title>
    <?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="auth-page height-auto bg-blue-600">
<!-- BEGIN CONTENT -->
<div class="wrapper animated fadeInDown">

    <div class="panel overflow-hidden">
        <div class="bg-light-blue-500 padding-top-25 no-margin-bottom font-size-20 color-white text-center text-uppercase">
            <i class="ion-log-in margin-right-5"></i> Sign In to Greeting Panel
        </div>


        <form role="form" method="POST" action="<?php echo e(url('/login')); ?>" id="checkform">

            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

            <div class="alert bg-light-blue-500 text-center color-white no-radius no-margin padding-top-15 padding-bottom-30 padding-left-20 padding-right-20">Please sign in to Greeting dashboard</div>
            <div class="box-body padding-md">
                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <input type="email" name="email" class="form-control input-lg" placeholder="E-Mail" value="<?php echo e(old('email')); ?>" />
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control input-lg" placeholder="Password"/>
                </div>

                <div class="form-group margin-top-20">
                    <input type="checkbox" class="js-switch" id="checkbox" name="remember" /><label for="checkbox" class="font-size-12 normal margin-left-10">Remember Me</label>
                </div>

                    <a class="btn btn-link" href="<?php echo e(url('/password/email')); ?>">Forgot Your Password?</a>

                <button type="submit" class="btn btn-dark bg-light-green-500 padding-10 btn-block color-white"><i class="ion-log-in"></i> Sign in</button>
            </div>
        </form>
        <div class="panel-footer padding-md no-margin no-border bg-light-blue-500 text-center color-white">&copy; 2015 IVAS.</div>
    </div>
</div>
<!-- END CONTENT -->
<!-- BEGIN JAVASCRIPTS -->

<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo e(asset('assets/plugins/jquery-1.11.1.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/bootstrap/js/holder.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/core.js')); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- bootstrap validator -->
<script src="<?php echo e(asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js')); ?>" type="text/javascript"></script>

<!-- switchery -->
<script src="<?php echo e(asset('assets/plugins/switchery/switchery.min.js')); ?>" type="text/javascript"></script>

<!-- maniac -->
    <script src="<?php echo e(asset('assets/js/maniac.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
    maniac.loadvalidator();
    maniac.loadswitchery();
</script>

<!-- END JAVASCRIPTS -->
</body>
</html>
<?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/auth/login.blade.php ENDPATH**/ ?>