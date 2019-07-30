$(function() {

    var usernameValid = /^[a-zA-Z0-9]{4,30}$/.test($('#username').val());  // check if initial username are valid
    var passwordValid = false;  // password input will always be blank initially
    
    $('#login').prop('disabled', true);  // disable login button

    // hide error messages
    $('#username-js-message').css("display", "none");
    $('#password-js-message-length').css("display", "none");
    $('#password-js-message-number').css("display", "none");
    $('#password-js-message-letter').css("display", "none");
    $('#password-js-message-special').css("display", "none");

    // when username input changes check if new value is valid
    $('#username').bind('propertychange keyup input cut paste', function() {
        var pattern = /^[a-zA-Z0-9]{4,30}$/;  // contains only letters and numbers with four to 30 characters
        var input=$(this);
        var username=pattern.test(input.val());
        if(username) {  // valid
            input.removeClass("invalid");
            $('#username-js-message').css("display", "none");
            usernameValid = true;
            if (usernameValid && passwordValid) {
                // if all inputs valid, make login button available
                $('#login').prop('disabled', false);
            }
        }
        else {  // invalid
            input.addClass("invalid");
            $('#username-js-message').css("display", "block");
            usernameValid = false;
            $('#login').prop('disabled', true);
        }
    });

    // when password input changes check if new value is valid
    $('#password').bind('propertychange keyup input cut paste', function() {
        var pattern = /(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#\$%&\?\-_])[a-zA-Z0-9!@#\$%&\?\-_]{6,}/;
        var input=$(this);
        var password=pattern.test(input.val());
        if(password) {  // valid
            input.removeClass("invalid");
            $('#password-js-message-length').css("display", "none");
            $('#password-js-message-number').css("display", "none");
            $('#password-js-message-letter').css("display", "none");
            $('#password-js-message-special').css("display", "none");
            passwordValid = true;
            if (usernameValid && passwordValid) {
                // if all inputs valid, make login button available
                $('#login').prop('disabled', false);
            }
        }
        else {  // invalid
            input.addClass("invalid");
            passwordValid = false;
            $('#login').prop('disabled', true);

            // password pattern broken up into the different qualifications
            var length = /.{6,}/;  // at least six characters long
            var number = /(?=.*[0-9])/;  // contain at least one number
            var letter = /(?=.*[a-zA-Z])/;  // contain at least one letter (case doesn't matter)
            var special = /(?=.*[!@#\$%&\?\-_])/;  // contain at least one special character: ! @ # $ % & ? - _ 

            // verify length 
            if (!length.test(input.val())) {
                $('#password-js-message-length').css("display", "block");
            } else {
                $('#password-js-message-length').css("display", "none");
            }

            // verify number
            if (!number.test(input.val())) {
                $('#password-js-message-number').css("display", "block");
            } else {
                $('#password-js-message-number').css("display", "none");
            }

            // verify letter
            if (!letter.test(input.val())) {
                $('#password-js-message-letter').css("display", "block");
            } else {
                $('#password-js-message-letter').css("display", "none");
            }

            // verify special character
            if (!special.test(input.val())) {
                $('#password-js-message-special').css("display", "block");
            } else {
                $('#password-js-message-special').css("display", "none");
            }
        }
    });

  });