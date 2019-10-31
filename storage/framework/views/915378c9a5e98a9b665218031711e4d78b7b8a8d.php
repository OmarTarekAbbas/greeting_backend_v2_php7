
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

<!-- datepicker -->
<script src="<?php echo e(asset('assets/plugins/datepicker/js/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>

<!-- maniac -->
<script src="<?php echo e(asset('assets/js/maniac.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/plugins/dropzone/dropzone.min.js')); ?>"></script>
<script type="text/javascript">
    maniac.loadvalidator();
    maniac.loaddatepicker();
    maniac.loadswitchery();
</script>

<!-- Select 2 Plugin -->
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
    $('#operator_list').select2();
    $('#occasion_list').select2();
</script>

<!-- END JAVASCRIPTS -->
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/javascripts.blade.php ENDPATH**/ ?>