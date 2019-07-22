$(function() {

  $( window ).resize(function(){ 
    if ($('.side').css("display") == "block") {
      $('#menuToggle input').prop( "checked", false );
      $('.mobile-menu').css("display", "none");
    }   
  });

  $('#menuToggle').click(function() {
    if ($('.mobile-menu').css("display") == "none") {
      $('.mobile-menu').slideDown("fast");
    }
    else {
      $('.mobile-menu').slideUp("fast");
    }
  });
  
});
