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
  autoplay: true,
  autoplayTimeout: 3000,
  nav: false,
  dots: true,
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
