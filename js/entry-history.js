$(function () {

    $('#history-form').validate({ // initialize the plugin
        rules: {
            date: {
                required: true
            }
        }
    });
    $('#get-history').prop('disabled', false);
    $("[name='date']").bind('propertychange keyup input cut paste', function () {
        if ($("[name='date']").valid() == true) {
            $('#get-history').prop('disabled', false);
        } else {
            $('#get-history').prop('disabled', true);
        }
    });

    $("#question-button").click(function () {
        var question = $(this);

        if ($("#display-key").css('display') == "none") {
            $("#display-key").css('display', 'inline-block');
            question.css('content', 'url(../../img/question-hover.png)');
        }
        else {
            $("#display-key").css('display', 'none');
            question.css('content', 'url(../../img/question.png)');
        }

        pageHeight = $(window).height() * 0.95;
        $(".footer").css("top", pageHeight);
        $(".footer-content").css("top", pageHeight);
    });

    $("#summary-question-button").click(function () {
        var question = $(this);

        if ($("#summary-display-key").css('display') == "none") {
            $("#summary-display-key").css('display', 'inline-block');
            question.css('content', 'url(../../img/question-hover.png)');
        }
        else {
            $("#summary-display-key").css('display', 'none');
            question.css('content', 'url(../../img/question.png)');
        }

        pageHeight = $(window).height() * 0.95;
        $(".footer").css("top", pageHeight);
        $(".footer-content").css("top", pageHeight);
    });

    $(".main-table").clone(true).appendTo('#main-table-scroll').addClass('clone');
    $(".summary-table").clone(true).appendTo('#summary-table-scroll').addClass('clone');



    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    document.getElementById("myBtn").onclick = function () {
        $("#myModal").css("display", "block");

        var padding = 40;

        // Get window size
        var bw = $(window).width() - ($('.mobile').css('display') == 'none' ? 160 : 0);
        var bh = window.innerHeight - ($('.mobile').css('display') == 'none' ? 0 : 50);
        // Get modal size
        var w = (298 + padding > bw) ? bw-padding : 298;
        $(".modal-content").css("max-width", w + "px");
        var h = $(".modal-content").height();

        // Update the css and center the modal on screen
        $(".modal-content").css("margin-top", (((bh - h) / 3) < 0 ? 0 : ((bh - h) / 3)) + "px");
        $(".modal-content").css("margin-left", (((bw - w - padding) / 2) < 0 ? 0 : ((bw - w - padding) / 2)) + "px");
        $(".modal-content").css("margin-right", (((bw - w - padding) / 2) < 0 ? 0 : ((bw - w - padding) / 2)) + "px");
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        $("#myModal").css("display", "none");
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == $("#myModal")) {
            $("#myModal").css("display", "none");

        }
    }

    $(window).resize(function () {
        if ($("#myModal").css("display") === "block") {
            var padding = 40;
            // Get window size
            var bw = $(window).width() - ($('.mobile').css('display') == 'none' ? 160 : 0);
            var bh = window.innerHeight - ($('.mobile').css('display') == 'none' ? 0 : 50);
            // Get modal size
            var w = (298 + padding > bw) ? bw : 298;
            $(".modal-content").css("width", w + "px");
            var h = $(".modal-content").height();

            // Update the css and center the modal on screen
            $(".modal-content").css("margin-top", (((bh - h) / 3) < 0 ? 0 : ((bh - h) / 3)) + "px");
            $(".modal-content").css("margin-left", (((bw - w - padding) / 2) < 0 ? 0 : ((bw - w - padding) / 2)) + "px");
            $(".modal-content").css("margin-right", (((bw - w - padding) / 2) < 0 ? 0 : ((bw - w - padding) / 2)) + "px");
        }
    })








});