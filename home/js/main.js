 $(document).ready(function(){
        $("#oredo").click(function(){
            $("#oredoForm").fadeIn(500);
            $("#orze").hide();
            $("#tarm").hide();
        });
    });


    $(document).ready(function(){
        $("#zain").click(function(){
            $("#zainForm").fadeIn(500);
            $("#orze").hide();
            $("#changeOP").hide();
            $("#tarm").hide();
        });
    });



$(window).load(function() {
    $("#loading").delay(2000).fadeOut(500);
    $("#loading-center").click(function() {
    $("#loading").fadeOut(500);
    })
})


