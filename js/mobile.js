$(function() {

  // hide mobile menu when screen is resized
  $( window ).resize(function(){ 
    if ($('.side').css("display") == "block") {
      $('#menuToggle input').prop( "checked", false );
      $('.mobile-menu').css("display", "none");
    }   
  });

  // opening and closing animation
  $('#menuToggle').click(function() {
    if ($('.mobile-menu').css("display") == "none") {
      $('.mobile-menu').slideDown("fast");
    }
    else {
      $('.mobile-menu').slideUp("fast");
    }
  });
  
});