/* global $, window, document */

//loading screen
$(window).on('load', function () {
    'use strict';
    $('.loading-overlay .spinner').fadeOut(800, function () {
        $(this).parent().fadeOut(500, function () {
            $('body').css('overflow', 'auto');
            $(this).remove();
        });
    });
});

// x
$('input').keyup(function() {
    'use strict';
    $('.validity').css('display', 'block');
});

//$('#viva, #zain').click(function(){
//    'use strict';
//    $('.shbka').css('display', 'none');
//    $('.form_content').css('display', 'block');
//});