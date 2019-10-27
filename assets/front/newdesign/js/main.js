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




/*function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}*/