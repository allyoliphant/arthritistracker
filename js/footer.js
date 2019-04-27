$(function() {

    var pageHeight = $(window).height()*0.94;

    $(".footer").css("top", pageHeight);
    $(".footer-content").css("top", pageHeight);

    $(window).resize(function() {
        pageHeight = $(window).height()*0.94;

        $(".footer").css("top", pageHeight);
        $(".footer-content").css("top", pageHeight);
    });

});