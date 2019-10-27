<div class="top-navbar">
    <div class="top-navbar-right"><a href="#" id="menu-right" data-activates="slide-out-right"><i class="fa fa-bars"></i></a></div>
    <div class="top-navbar-left back_btn"><a data-activates="slide-out-right"><i class="fa fa-caret-left"></i></a></div>
    @if(!isset($_GET['operator_id']))
        <div class="top-navbar-left"><a href="{{url('search')}}" data-activates="slide-out-right"><i class="fa fa-search"></i></a></div>
    @else
        <div class="top-navbar-left"><a href="{{url('search?operator_id='.$_GET['operator_id'])}}" data-activates="slide-out-right"><i class="fa fa-search"></i></a></div>
    @endif
    <div class="site-title" >

       <?php
        $settings = Helper::init()[1] ;
        ?>
        @if($settings!=null && file_exists($settings[1]->value))
            <img src="{{url($settings[1]->value)}}" alt="وفرلى">
        @else
            <img src="{{url('images/logo.png')}}" alt="وفرلى">
        @endif
    </div>
</div> 