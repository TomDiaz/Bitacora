

$( ".form-control" ).focus(function() {
       

     $(".form-control.active").next().css( "left", "10px");
     $(".form-control.active").next().css( "opacity", 1);

     $(this).next().css( "left", "300px");
     $(this).next().css( "opacity", 0);

});



$( ".form-control" ).change(function() {
    if(this.value){
        $(this).removeClass( "active" );
    }

    else{
        $(this).addClass( "active" );
    }
});


