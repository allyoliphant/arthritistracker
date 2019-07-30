$(function () {

    // open modal - opens logout modal
    $('a.button[rel="ajax:modal"]').off('click').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
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

    // open modal - opens logout modal (mobile)
    $('a.mobile-btn[rel="ajax:modal"]').off('click').click(function (e) {
        // close the mobile menu
        $('#menuToggle input').prop( "checked", false );
        $('.mobile-menu').css("display", "none");
        
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
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
    
});