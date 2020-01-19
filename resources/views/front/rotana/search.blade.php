<!-- Start Search -->
<div class="search text-center">
     <i class="fas fa-search"></i>
     <form action="{{url('Search_v5/'.UID())}}" method="get">
          <input class="hide input-right" type="text" name="search" id="myInput" value=""
               placeholder="{!! static_lang('search') ?static_lang('search') : 'بحث' !!}" title="">
          <span class="bord"></span>
     </form>
</div>
<!-- End Search -->