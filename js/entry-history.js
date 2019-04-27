$(function() {

    $("#question-button").click(function() {
        var question = $(this);

        if ($(".display-key").css('display') == "none") {
            $(".display-key").css('display', 'inline-block');
            question.css('content', 'url(../../question-hover.png)');
        }
        else {
            $(".display-key").css('display', 'none');
            question.css('content', 'url(../../question.png)');
        }
        
        
        pageHeight = $(window).height()*0.94;
        $(".footer").css("top", pageHeight);
        $(".footer-content").css("top", pageHeight);
    });

});