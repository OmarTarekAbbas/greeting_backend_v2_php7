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
        translate(tnum);

        $('.more_lang .lang').click(function () {
            $(this).addClass('selected').siblings().removeClass('selected');
            $('.more_lang').removeClass('active');

            var img = $(this).find('img').attr('src');
            var lang = $(this).attr('data-value');
            var tnum = lang;
            translate(tnum);

            $('.current_lang .lang-txt').text(lang);
            $('.current_lang img').attr('src', img);

            if (lang == 'ar') {
                $('body').attr('dir', 'rtl');
            } else {
                $('body').attr('dir', 'ltr');
            }

        });
    });

    function translate(tnum) {
        $('h1').text(trans[0][tnum]);
        // $('p').text(trans[1][tnum]);
        // $('.content a span').text(trans[2][tnum]);
    }

    var trans = [{
            // ar: 'حرباء'
        }, {
            /* en: 'For sheer breadth of freakish anatomical features, the chameleon has few rivals. A tongue far longer than its body, shooting out to snatch insects in a fraction of a second. Telescopic-vision eyes that swivel independently in domed turrets. Feet with toes fused into mitten-like pincers. Horns sprouting from brow and snout. Knobbly nasal ornaments. A skin flap circling the neck like a lace ruff on an Elizabethan noble.',
            ar: 'لمجرد اتساع الميزات التشريحية فظيع، والحرباء لديها منافسيه قليلة. اللسان أطول بكثير من جسمه، واطلاق النار لانتزاع الحشرات في جزء صغير من الثانية. عيون الرؤية تلسكوبية التي قطب بشكل مستقل في الأبراج القبة. قدم مع أصابع تنصهر في وسط-- مثل بينكرز. هورنز، تبرعم، من، الحواجب، أيضا، سنوت. نوبل الحلي الأنفية. جلد رفرف تحلق الرقبة مثل الرباط روف على إليزابيثية أنيقة.'*/
        }, {
            /* en: 'See More',
            ar: 'مشاهدة المزيد' */
        },

    ];

/* End Lang */


/*function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}*/