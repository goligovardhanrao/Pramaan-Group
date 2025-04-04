// Page preload ------------------
$(window).load(function() {
    "use strict";
    $(".loader").fadeOut(500, function() {
         var firstTime = localStorage.getItem("marketingFirstTime");

    if(! firstTime){
       // all your current code
       localStorage.setItem("marketingFirstTime", true);
        $('.popup').fadeIn(350);
    }
  
    $("#top").animate({
            opacity: "1"
        }, 500);
    });
});

  $('.close').on('click', function(e)  {
        $('.popup').fadeOut(350);
        //$('#hidden').val(1);
        e.preventDefault();
    });
 
