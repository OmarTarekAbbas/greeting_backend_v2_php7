/* global $, window, document */

//to back
$(document).on('click', '.back', function () {
    'use strict';
    parent.history.back();
});


//loading screen
$(window).on('load', function () {
    'use strict';
    $('.loading-overlay .spinner').fadeOut(500, function () {
        $(this).parent().fadeOut(500, function () {
            $(this).remove();
        });
    });
});


// wow
new WOW().init();


//owl carousel 1 {team, testimonial}
$('.owl_main').owlCarousel({
    center: true,
    rtl: true,
    loop: true,
    //margin: 10,
    nav: true,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});
$(".owl-prev").html('<i class="fas fa-chevron-left"></i>');
$(".owl-next").html('<i class="fas fa-chevron-right"></i>');

//owl carousel 2 {team, testimonial}
$('.owl_three').owlCarousel({
    center: false,
    rtl: true,
    loop: true,
    //margin: 10,
    nav: true,
    dots: false,
    responsive: {
        0: {
            items: 3
        },
        600: {
            items: 4
        },
        1000: {
            items: 5
        }
    }
});
$(".owl-prev").html('<i class="fas fa-chevron-left"></i>');
$(".owl-next").html('<i class="fas fa-chevron-right"></i>');

//owl carousel 3 {team, testimonial}
$('.owl_one').owlCarousel({
  center: false,
  rtl: true,
  loop: false,
  //margin: 10,
  nav: true,
  dots: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});
$(".owl-prev").html('<i class="fas fa-chevron-left"></i>');
$(".owl-next").html('<i class="fas fa-chevron-right"></i>');

//owl carousel 4 {team, testimonial}
$('.owl_two').owlCarousel({
  center: false,
  rtl: true,
  loop: false,
  //margin: 10,
  nav: true,
  dots: false,
    responsive: {
        0: {
            items: 2
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});
$(".owl-prev").html('<i class="fas fa-chevron-left fa-2x"></i>');
$(".owl-next").html('<i class="fas fa-chevron-right fa-2x"></i>');
//menu
$(".show-menu").click(function () {
    'use strict';
    $("nav").toggleClass("show");
});

$(document).ready(function () {
    $('.dropdown-submenu a.test').on("click", function (e) {
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });
});


//filter content with isotope
$(window).ready(function () {
    'use strict';
    var $container = $('.videos');
    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });
    $('.btns_type .btn').click(function () {
        $('.btns_type .btn.is-active').removeClass('is-active');
        $(this).addClass('is-active');
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
        return false;
    });
});

//------------------------------------------------------------

//current page
$(function () {
    var url = window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");
    $('footer a').each(function () {
        if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
            $(this).addClass('current');
        }
    });
});

//------------------------------------------------------------

$('.title').each( function () {
    if ($('.title').text().length > 15) {
    $('.fav_cat .label_title a .title').css({
        "text-overflow": "ellipsis",
        "overflow": "hidden"
        })
    }
})



var arabicPattern = /[\u0600-\u06ff]|[\u0750-\u077f]|[\ufb50-\ufbc1]|[\ufbd3-\ufd3f]|[\ufd50-\ufd8f]|[\ufd92-\ufdc7]|[\ufe70-\ufefc]|[\uFDF0-\uFDFD]|[٠١٢٣٤٥٦٧٨٩]/;
  $('.title').each( function() {
      var x = $(this).text();
      if (arabicPattern.test(x)) {
          $(this).css('direction', 'rtl');
      } else {
          $(this).css('direction', 'ltr');
          $(this).css('font-family', 'serif');
      }
  });


$('.category_title .a_title').each( function() {
    var x = $(this).text();
    if (arabicPattern.test(x)) {
        $(this).css('direction', 'rtl');
    } else {
        $(this).css('direction', 'ltr');
        $(this).css('font-family', 'serif');
    }
});


//----------------------------------------------------
/*
function parseArabic(str) {
    return Number( str.replace(/[٠١٢٣٤٥٦٧٨٩]/g, function(d) {
        return d.charCodeAt(0) - 1632; // Convert Arabic numbers
    }).replace(/[۰۱۲۳۴۵۶۷۸۹]/g, function(d) {
        return d.charCodeAt(0) - 1776; // Convert Persian numbers
    }) );
}

*/
// var numPattern = /[0123456789]/g;

// $('.category_title .a_title').each( function() {
//     var y = $(this).text();
//     //parseArabic(y);
//     if (numPattern.test(y)) {
//         $(this).css('font-family', 'myFont');
//     } else {
//         $(this).css('font-family', 'serif');
//     }
// });
