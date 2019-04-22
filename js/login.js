$(function() {

    var usernameValid = /^[a-zA-Z0-9]{4,30}$/.test($('#username').val());
    var passwordValid = false;
    
    $('#login').prop('disabled', true);
    $('#username-js-message').css("display", "none");
    $('#password-js-message-length').css("display", "none");
    $('#password-js-message-number').css("display", "none");
    $('#password-js-message-letter').css("display", "none");
    $('#password-js-message-special').css("display", "none");

    $('#username').bind('propertychange keyup input cut paste', function() {
        var pattern = /^[a-zA-Z0-9]{6,30}$/;
        var input=$(this);
        var username=pattern.test(input.val());
        if(username) {
            input.removeClass("invalid");
            $('#username-js-message').css("display", "none");
            usernameValid = true;
            if (usernameValid && passwordValid) {
                $('#login').prop('disabled', false);
            }
        }
        else {
            input.addClass("invalid");
            $('#username-js-message').css("display", "block");
            usernameValid = false;
            $('#login').prop('disabled', true);
        }
    });

    $('#password').bind('propertychange keyup input cut paste', function() {
        var pattern = /(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#\$%&\?\-_])[a-zA-Z0-9!@#\$%&\?\-_]{6,30}/;
        var input=$(this);
        var password=pattern.test(input.val());
        if(password) {
            input.removeClass("invalid");
            $('#password-js-message-length').css("display", "none");
            $('#password-js-message-number').css("display", "none");
            $('#password-js-message-letter').css("display", "none");
            $('#password-js-message-special').css("display", "none");
            passwordValid = true;
            if (usernameValid && passwordValid) {
                $('#login').prop('disabled', false);
            }
        }
        else {
            input.addClass("invalid");
            passwordValid = false;
            $('#login').prop('disabled', true);

            var length = /.{6,30}/;
            var number = /(?=.*[0-9])/;
            var letter = /(?=.*[a-zA-Z])/;
            var special = /(?=.*[!@#\$%&\?\-_])/;
            if (!length.test(input.val())) {
                $('#password-js-message-length').css("display", "block");
            } else {
                $('#password-js-message-length').css("display", "none");
            }
            if (!number.test(input.val())) {
                $('#password-js-message-number').css("display", "block");
            } else {
                $('#password-js-message-number').css("display", "none");
            }
            if (!letter.test(input.val())) {
                $('#password-js-message-letter').css("display", "block");
            } else {
                $('#password-js-message-letter').css("display", "none");
            }
            if (!special.test(input.val())) {
                $('#password-js-message-special').css("display", "block");
            } else {
                $('#password-js-message-special').css("display", "none");
            }
        }
    });

  });

