$(function () {

    $('a.button[rel="ajax:modal"]').off('click').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            success: function (newHTML, textStatus, jqXHR) {
                $('.modal').each(modal => {
                    $('.modal').get(modal).remove();
                });
                $(newHTML).appendTo('body').modal();
            }
        });
        return false;
    });

    $('a.mobile-btn[rel="ajax:modal"]').off('click').click(function (e) {
        $('#menuToggle input').prop( "checked", false );
        $('.mobile-menu').css("display", "none");
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            success: function (newHTML, textStatus, jqXHR) {
                $('.modal').each(modal => {
                    $('.modal').get(modal).remove();
                });
                $(newHTML).appendTo('body').modal();
            }
        });
        return false;
    });
    
});