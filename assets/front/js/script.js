/*global $, console ,swiper, fancybox*/
$(document).ready(function () {

  'use strict';

  // preloader 
  $(window).ready(function () {
    $('#preloader').fadeOut('slow', function () {
      $(this).remove();
    });
  });


  // trigger owl carousel 
  $('.owl-carousel').owlCarousel({
    rtl:true,
    loop: false,
    margin: 20,
    nav: false ,
    dots: false,
    responsive: {
      0: {
        items: 3
      },
      600: {
        items: 3
      },
      1000: {
        items: 5
      }
    }
  })
 //$( ".owl-prev").html('<i class="fa fa-chevron-left"></i>');
 //$( ".owl-next").html('<i class="fa fa-chevron-right"></i>');

  // filter catergoy

  $('.filter a').click(function (e) {
    e.preventDefault();
    var a = $(this).attr('href');
    a = a.substr(1);
    $('.check a').each(function () {
      if (!$(this).hasClass(a) && a != 'all')
        $(this).addClass('hide');
      else
        $(this).removeClass('hide');
    });


  });

  $('.filter a').click(function (e) {
    e.preventDefault();
    var a = $(this).attr('href');
    a = a.substr(1);
    $('.sounds li').each(function () {
      if (!$(this).hasClass(a) && a != 'all')
        $(this).addClass('sound_hide');
      else
        $(this).removeClass('sound_hide');
    });
  });


  (function ($) {

    // Handle click on toggle search button
    $('#toggle-search').click(function () {
      $('#search-form, #toggle-search').toggleClass('open');
      return false;
    });

    // Handle click on search submit button
    $('#search-form input[type=submit]').click(function () {
      $('#search-form, #toggle-search').toggleClass('open');
      return true;
    });

    // Clicking outside the search form closes it
    $(document).click(function (event) {
      var target = $(event.target);

      // if (!target.is('#toggle-search') && !target.closest('#search-form').size()) {
      //   $('#search-form, #toggle-search').removeClass('open');
      // }
    });

  })(jQuery);




  $('header a.icon, #overlay').click(function () {
    $('aside').toggleClass('showAside');
    $("#overlay").toggleClass("overlay");
    $("#overlay").toggleClass("add");


  });



  $(function(){
    $('.item').click(function(){
      $(this).parent().addClass('active1').siblings().removeClass('active1');
    })
  })


var x = $('.active1').parent();
$('.active1').parent().remove();
$(".owl-stage > div:nth-child(1)").after(x);


  $(function(){
    $('.cat-item').click(function(){
      $(this).parent().addClass('active2').siblings().removeClass('active2');
    })
  })



    $(document).on("click",".np-play",function(e) {
    //$('.np-play').click(function (e) {
        
        var audio = document.getElementById('audio_test');
        
        $('#audioSource').attr('src', $(this).find('.fa').attr('data-src'));
       
        
        if ($(this).find('.fa').hasClass('fa-play')) {
            
            audio.load();

            audio.play();
            // $(this).parent().addClass('active_play').siblings().removeClass('active_play');

            $('.np-play').find('.fa').removeClass('fa-pause').addClass('fa-play');
            
            $(this).find('.fa').addClass('fa-pause').removeClass('fa-play');
            
        } else {
            // $(this).parent().removeClass('active_play');
            $('.np-play').find('.fa').addClass('fa-play');
            
            $(this).find('.fa').removeClass('fa-pause').addClass('fa-play');
            
            audio.pause();
            
        }
        
    });



});


//to back 
$(document).on('click', '.back_botton', function () {
    'use strict';
    parent.history.back();
});


/*function goBack() {

  'use strict';

  window.history.back();

}*/

    function playPause(vid){
        var vid = document.getElementById(vid);
        if(vid.paused){
            vid.play();
            document.getElementById('video_icon').style.display="none";
        } else {
            vid.pause(); 
            document.getElementById('video_icon').style.display="block";
        }
    }


    //--------- active link -----------
$(function () {
    var url = window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");
    $('.buttom_menu a').each(function () {
        if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
            $(this).addClass('current');
        }
    });
});

