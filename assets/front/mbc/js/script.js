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
		$(this).parent().fadeOut(800, function () {
			$('body').css('overflow', 'auto');
			$(this).remove();
		});
	});
});

/* Video Stop */
document.addEventListener('play', function (e) {
	var videos = document.getElementsByTagName('video');
	for (var i = 0, len = videos.length; i < len; i++) {
		if (videos[i] != e.target) {
			videos[i].pause();
		}
	}
}, true);

/* Video Play */
// $(document).ready(function () {
// 	$('.play_video_i').click(function () {
// 		if ($(this).parent().prev().get(0).paused) {
// 			$(this).parent().prev().get(0).play();
// 			$('.play_video').hide();
			
// 		}

// 		else {
// 			$('.video-fluid').parent().prev().get(0).paused();
// 			$('.play_video').show();
// 		}
// 	});

// 	$('.video-fluid').on('ended', function () {
// 		$('.play_video').show();
// 	});
// });

// wow
new WOW().init();

//owl carousel {team, testimonial}
$('.owl-three').owlCarousel({
	center: true,
	// rtl: true,
	width: true,
	loop: true,
	nav: true,
	dots: false,
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

$('.owl-two').owlCarousel({
	// center: true,
	// rtl: true,
	width: true,
	loop: true,
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
			items: 2
		}
	}
});

$('.owl-one').owlCarousel({
	// center: true,
	// rtl: true,
	width: true,
	loop: true,
	nav: true,
	dots: false,
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
$(".owl-prev").html('<i class="fas fa-chevron-left"></i>');
$(".owl-next").html('<i class="fas fa-chevron-right"></i>');


$('.owl-video').owlCarousel({
	items: 1,
	merge: true,
	loop: true,
	// autoplay: true,
	margin: 10,
	video: true,
	lazyLoad: true,
	center: true,
	responsive: {
		480: {
			items: 1
		},
		600: {
			items: 1
		}
	}
})




//heart
$('.heart').click(function () {
	$(this).toggleClass('active');
});

//current page
$(function () {
	var url = window.location.pathname,
		urlRegExp = new RegExp(url.replace(/\/$/, '') + "$");
	$('footer .footer a').each(function () {
		if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
			$(this).addClass('current');
		}
	});
});

//------------------------------------------------------------

var arabicPattern = /[\u0600-\u06ff]|[\u0750-\u077f]|[\ufb50-\ufbc1]|[\ufbd3-\ufd3f]|[\ufd50-\ufd8f]|[\ufd92-\ufdc7]|[\ufe70-\ufefc]|[\uFDF0-\uFDFD]/;
$('.title').each(function () {
	var x = $(this).text();
	if (arabicPattern.test(x)) {
		console.log(arabicPattern.test(x));
		$(this).css('direction', 'rtl');
	} else {
		$(this).css('direction', 'ltr');
	}
});