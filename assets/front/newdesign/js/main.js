/*-------------------------------------
   preloader
    -------------------------------------*/
$(window).ready(function () {
    $('#preloader').fadeOut('slow', function () {
        $(this).remove();
    });
});

/*-------------------------------------
   Back Botton
    -------------------------------------*/
$(document).on('click', '.back_botton', function () {
    parent.history.back();
    //$.mobile.back();
});

/*-------------------------------------
   Menu Overlay
    -------------------------------------*/
$('.menu, #overlay').click(function () {
    $('aside').toggleClass('showAside');
    $("#overlay").toggleClass("overlay");
    $("#overlay").toggleClass("add");
});

/* Start Lang */
    var tnum = 'en';

    $(document).ready(function () {

        $(document).click(function (e) {
            $('.translate_wrapper, .more_lang').removeClass('active');
        });

        $('.translate_wrapper .current_lang').click(function (e) {
            e.stopPropagation();
            $(this).parent().toggleClass('active');

            setTimeout(function () {
                $('.more_lang').toggleClass('active');
            }, 5);
        });

        /*TRANSLATE*/
        $('.more_lang .lang').click(function () {
            $(this).addClass('selected').siblings().removeClass('selected');
            $('.more_lang').removeClass('active');

            var img = $(this).find('img').attr('src');
            var lang = $(this).attr('data-value');
            

            $('.current_lang .lang-txt').text(lang);
            $('.current_lang img').attr('src', img);

            if (lang == 'ar') {
                $('body').attr('dir', 'rtl');
            } else {
                $('body').attr('dir', 'ltr');
            }
        });
    });
/* End Lang */


/*function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}*/