$(function() {

  $('#menuToggle').click(function() {
    if ($('.mobile-menu').css("display") == "none") {
      $('.mobile-menu').slideDown("fast");
    }
    else {
      $('.mobile-menu').slideUp("fast");
    }
  });
  
});
