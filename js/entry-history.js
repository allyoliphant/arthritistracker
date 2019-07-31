$(function () {

    $('#history-form').validate({ // initialize the validation plugin
        rules: {
            date: {
                required: true
            }
        }
    });

    $('#get-history').prop('disabled', false);  // disable get history button

    // when date input changes, check if it is valid
    $("[name='date']").bind('propertychange keyup input cut paste', function () {
        if ($("[name='date']").valid() == true) {
            $('#get-history').prop('disabled', false);
        } else {
            $('#get-history').prop('disabled', true);
        }
    });

    // entry history graph key stuff
    $("#question-button").click(function () {
        var question = $(this);

        if ($("#display-key").css('display') == "none") {
            // display key
            $("#display-key").css('display', 'inline-block');
            question.css('content', 'url(/img/question-hover.png)');
        }
        else {
            // hide key
            $("#display-key").css('display', 'none');
            question.css('content', 'url(/img/question.png)');
        }

        // adjust footer
        pageHeight = $(window).height() * 0.95;
        $(".footer").css("top", pageHeight);
        $(".footer-content").css("top", pageHeight);
    });

    // entry summary graphs key stuff
    $("#summary-question-button").click(function () {
        var question = $(this);

        if ($("#summary-display-key").css('display') == "none") {
            // display key
            $("#summary-display-key").css('display', 'inline-block');
            question.css('content', 'url(/img/question-hover.png)');
        }
        else {
            // hide key
            $("#summary-display-key").css('display', 'none');
            question.css('content', 'url(/img/question.png)');
        }

        // adjust footer
        pageHeight = $(window).height() * 0.95;
        $(".footer").css("top", pageHeight);
        $(".footer-content").css("top", pageHeight);
    });

    // keep y-axis visible on the entry history graph when table is scrollable
    $(".main-table").clone(true).appendTo('#main-table-scroll').addClass('clone');
    $(".summary-table").clone(true).appendTo('#summary-table-scroll').addClass('clone');


    
    /**  entry modal stuff  **/

    $.modal.defaults = {
        closeExisting: true,  // only one modal open at once
        clickClose: false,  // have to use close button to close modal
        showClose: true,  // show close x at the top right
        showSpinner: true  // show spinner when loading ajax stuff
    };

    // open ajax modal - opens entry modal 
    $('a.no-style-link[rel="ajax:modal"]').off('click').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            data: {
                'entry': $(this).find('input').val()
            },
            success: function (newHTML, textStatus, jqXHR) {
                // remove previous modals
                $('.modal').each(modal => {
                    $('.modal').get(modal).remove();
                });
                // add new modal
                $(newHTML).appendTo('body').modal();
            }
        });
        return false;
    });

    // close ajax modal
    $('a[rel="modal:close"]').off('click').click(function () {
        // remove modal
        $('.blocker').each(modal => {
            $('.blocker').get(modal).remove();
        });
        return false;
    });

});