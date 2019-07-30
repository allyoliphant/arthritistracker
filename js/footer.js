$(function() {

    // javascript to force footer to the bottom of the page

    var pageHeight = $(window).height()*0.95;

    $(".footer").css("top", pageHeight);
    $(".footer-content").css("top", pageHeight);

    $(window).resize(function() {
        pageHeight = $(window).height()*0.95;

        $(".footer").css("top", pageHeight);
        $(".footer-content").css("top", pageHeight);
    });

});