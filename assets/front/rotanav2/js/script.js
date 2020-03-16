$(function () {
  var url = window.location.href;
  $(".foot_link a").each(function () {});
  $(".foot_link a").each(function () {
    if (url == (this.href)) {
      $("#indexed").removeClass("active_menu");
      $(this).closest("a").addClass("active_menu");
    }
  });
});

$('#search_input').click(function(){
  $('.active_menu').removeClass('active_menu')
  $(this).addClass('active_menu');
})

$('.owl_one').owlCarousel({
  loop: true,
  margin: 0,
  autoplay: false,
  autoplayTimeout: 3000,
  nav: false,
  dots: false,
  center: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 1
    }
  }
});

$('.owl_two').owlCarousel({
  loop: true,
  margin: 0,
  autoplay: false,
  autoplayTimeout: 3000,
  nav: false,
  dots: false,
  center: false,
  responsive: {
    0: {
      items: 2
    },
    600: {
      items: 2
    },
    1000: {
      items: 2
    }
  }
});

$('.owl_three, .owl_filter').owlCarousel({
  loop: true,
  margin: 0,
  autoplay: false,
  autoplayTimeout: 3000,
  nav: false,
  dots: false,
  center: true,
  responsive: {
    0: {
      items: 3
    },
    600: {
      items: 3
    },
    1000: {
      items: 3
    }
  }
});

$('.owl-video').owlCarousel({
  items: 1,
  merge: true,
  loop: true,
  autoplay: false,
  autoplayTimeout: 3000,
  margin: 0,
  video: true,
  lazyLoad: true,
  center: true,
  nav: false,
  dots: false,
  animateOut: 'lightSpeedOut',
  animateIn: 'lightSpeedIn',
  responsive: {
    480: {
      items: 1
    },
    600: {
      items: 1
    }
  }
})

$('.heart_heart').click(function () {
  $(this).toggleClass('active_heart');
});

// var elem = document.getElementById("myvideo");
// function openFullscreen() {
//   if (elem.requestFullscreen) {
//     elem.requestFullscreen();
//   } else if (elem.mozRequestFullScreen) { /* Firefox */
//     elem.mozRequestFullScreen();
//   } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
//     elem.webkitRequestFullscreen();
//   } else if (elem.msRequestFullscreen) { /* IE/Edge */
//     elem.msRequestFullscreen();
//   }
// }
