
$("#form1").submit(function(e){
        e.preventDefault();
        $('#myModal').modal('show');
    });


$(window).load(function() {
    $("#loading").delay(2000).fadeOut(500);
    $("#loading-center").click(function() {
    $("#loading").fadeOut(500);
    })
})