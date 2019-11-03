<?php $__env->startSection('title'); ?>
    Occasions
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    <?php if(isset($occasion) && $occasion): ?> <?php echo e($occasion->title); ?> <?php else: ?> Occasions <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Occasions
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Occasions</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="right">
            <a href="<?php echo e(url('admin/occasions/create')); ?>"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                  <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                  <div id="tag_container">
                    <?php echo $__env->make('admin.occasions.result', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <span class="divider"></span>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value
    $.ajax({
        url: "<?php echo e(url('admin/occasions')); ?>",
        type: "get",
        data:{
            'search_value' : filter
        }
    }).done(function(data)
        {
            $("#tag_container").empty().html(data);
        })

        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            console.log('No response from server');
        });
}
</script>

<script type="text/javascript">

	$(window).on('hashchange', function() {
	        if (window.location.hash) {
	            var page = window.location.hash.replace('#', '');
	            if (page == Number.NaN || page <= 0) {
	                return false;
	            }else{
	                getData(page,0);
	            }
	        }
        });

	$(document).ready(function()
	{
	     $(document).on('click', '.pagination a',function(event)
	    {
	        event.preventDefault();
	        $('li').removeClass('active');
	        $(this).parent('li').addClass('active');
	        var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
            let url = new URL($(this).attr('href'));
            search = url.searchParams.get('search_value') ? url.searchParams.get('search_value') : 0;  // to get search_value from url
            console.log(search);
	        getData(page,search);
	    });

	});
	function getData(page , value){
        append = '';
        if(value){
            append = '&search_value='+ value
        }
	        $.ajax(
	        {
	            url: '?page=' + page+append,
	            type: "get",
	            datatype: "html"
	        })
	        .done(function(data)
	        {
	            $("#tag_container").empty().html(data);
	            //location.hash = page;
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              console.log('No response from server');
	        });

	}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/greeting_backend_v2_php7/resources/views/admin/occasions/index.blade.php ENDPATH**/ ?>