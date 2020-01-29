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
$('#phone').keyup(function () {
    'use strict';
    $('.validity').css('display', 'block');
    if ($(this).val() == '') {
        $('.validity').css('display', 'none');
    }
});

//---------------------------------------
/*
$('#viva, #zain, #ooredoo').click(function () {
    'use strict';
    $('.shbka').css('display', 'none');
    $('#video').css('display', 'none');
    $('.strip').css('margin-top', 20);
    $('.form_content').css('display', 'block');
});
*/
//---------------------------------------

$('#phone').focusin(function () {
    'use strict';
    $('#video').css('display', 'none');
    $('.strip').css('margin-top', 20);
});

$('#phone').blur(function () {
    'use strict';
    $('#video').css('display', 'block');
    $('.strip').css('margin-top', -10);


});
/*
$('.back').click(function () {
    'use strict';
    $('#video').css('display', 'block');
    $('.strip').css('margin-top', -10);
    $('.form_content').css('display', 'none');
    $('.shbka').css('display', 'block');
});
*/


$('#viva_submit').focusin(function () {
    $('#form_viva').submit()
});

