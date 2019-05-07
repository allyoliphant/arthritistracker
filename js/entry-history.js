$(function() {

    $('#history-form').validate({ // initialize the plugin
        rules: {
            date: {
                required: true
            }
        }
    });    
    $('#get-history').prop('disabled', false);    
    $("[name='date']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='date']").valid() == true) {
            $('#get-history').prop('disabled', false);
        } else {
            $('#get-history').prop('disabled', true);
        }
    });

    $("#question-button").click(function() {
        var question = $(this);

        if ($(".display-key").css('display') == "none") {
            $(".display-key").css('display', 'inline-block');
            question.css('content', 'url(../../img/question-hover.png)');
        }
        else {
            $(".display-key").css('display', 'none');
            question.css('content', 'url(../../img/question.png)');
        }        
        
        pageHeight = $(window).height()*0.94;
        $(".footer").css("top", pageHeight);
        $(".footer-content").css("top", pageHeight);
    });

});