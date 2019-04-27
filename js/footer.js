$(function() {

    var pageHeight = $(window).height()*0.94;

    $(".footer").css("top", pageHeight);
    $(".footer-content").css("top", pageHeight);

    $(".footer").css("left", 180);
    $(".footer-content").css("left", 180);
    $(".footer").css("right", 20);
    $(".footer-content").css("right", 20);

    $(window).resize(function() {
        pageHeight = $(window).height()*0.94;

        $(".footer").css("top", pageHeight);
        $(".footer-content").css("top", pageHeight);
    });

});