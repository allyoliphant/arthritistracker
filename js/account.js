$(function() {
    
    var nameValid = /^(?=.*[a-zA-Z0-9])[a-zA-Z0-9\s]{1,30}$/.test($('#name').val());  // check if initial name are valid
    var usernameValid = /^[a-zA-Z0-9]{4,30}$/.test($('#username').val());  // check if initial username are valid
    var passwordValid = false;  // default false since input is left empty initially
    var emailValid = /^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9-\.]+\.[a-zA-Z0-9-]+$/.test($('#email').val());  // check if initial email are valid
    
    $('#save').prop('disabled', true);  // disable save button
    
    // hide error messages
    $('#name-js-message').css("display", "none");
    $('#username-js-message').css("display", "none");
    $('#password-js-message-length').css("display", "none");
    $('#password-js-message-number').css("display", "none");
    $('#password-js-message-letter').css("display", "none");
    $('#password-js-message-special').css("display", "none");
    $('#confirm-password-js-message').css("display", "none");
    $('#email-js-message').css("display", "none");

    // when name input changes check if new value is valid
    $('#name').bind('propertychange keyup input cut paste', function() {
        var pattern = /^(?=.*[a-zA-Z])[a-zA-Z\s]{1,30}$/;  // contains only letters and spaces with at least one letter and no more than 30 characters (space included)
        var input=$(this);
        var name=pattern.test(input.val());
        if(name) {  // valid
            input.removeClass("invalid");
            $('#name-js-message').css("display", "none");
            nameValid = true;
            if (nameValid && usernameValid && passwordValid && emailValid) {
                // if all inputs valid, make save button available
                $('#save').prop('disabled', false);
            }
        }
        else {  // invalid
            input.addClass("invalid");
            $('#name-js-message').css("display", "block");
            nameValid = false;
            $('#save').prop('disabled', true);
        }
    });

    // when username input changes check if new value is valid
    $('#username').bind('propertychange keyup input cut paste', function() {
        var pattern = /^[a-zA-Z0-9]{4,30}$/;  // contains only letters and numbers with four to 30 characters
        var input=$(this);
        var username=pattern.test(input.val());
        if(username) {  // valid
            input.removeClass("invalid");
            $('#username-js-message').css("display", "none");
            usernameValid = true;
            if (nameValid && usernameValid && passwordValid && emailValid) {
                // if all inputs valid, make save button available
                $('#save').prop('disabled', false);
            }
        }
        else {  // invalid
            input.addClass("invalid");
            $('#username-js-message').css("display", "block");
            usernameValid = false;
            $('#save').prop('disabled', true);
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
            
            if(input.val() == $('#confirm-password').val()) {  // check if password and confirm password match
                passwordValid = true;
                if (nameValid && usernameValid && passwordValid && emailValid) {
                    // if all inputs valid, make save button available
                    $('#save').prop('disabled', false);
                }
            }
            else {  // password and confirm password do not match
                passwordValid = false;
                $('#save').prop('disabled', true);
            }
        }
        else {  // invalid
            input.addClass("invalid");
            passwordValid = false;
            $('#save').prop('disabled', true);

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

        // check new password value with confirm password value
        if ($('#confirm-password').val() != "") {  // check if confirm password has a value
            if(input.val() == $('#confirm-password').val()) {  // check if password and confirm password match
                $('#confirm-password').removeClass("invalid");
                $('#confirm-password-js-message').css("display", "none");
                passwordValid = true;
                if (nameValid && usernameValid && passwordValid && emailValid) {
                    // if all inputs valid, make save button available
                    $('#save').prop('disabled', false);
                }
            }
            else {  // password and confirm password do not match
                $('#confirm-password').addClass("invalid");
                $('#confirm-password-js-message').css("display", "block");
                passwordValid = false;
                $('#save').prop('disabled', true);
            }
        }        
    });

    // when confirm password input changes check if new value is valid
    $('#confirm-password').bind('propertychange keyup input cut paste', function() {
        var input=$(this);
        if(input.val() == $('#password').val()) {  // check if password and confirm password match
            input.removeClass("invalid");
            $('#confirm-password-js-message').css("display", "none");
            passwordValid = true;
            if (nameValid && usernameValid && passwordValid && emailValid) {
                // if all inputs valid, make save button available
                $('#save').prop('disabled', false);
            }
        }
        else {  // password and confirm password do not match
            input.addClass("invalid");
            $('#confirm-password-js-message').css("display", "block");
            passwordValid = false;
            $('#save').prop('disabled', true);
        }
    });

    // when email input changes check if new value is valid
    $('#email').bind('propertychange keyup input cut paste', function() {
        var pattern = /^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9-\.]+\.[a-zA-Z0-9-]+$/;
        var input=$(this);
        var email=pattern.test(input.val());
        if(email) {  // valid
            input.removeClass("invalid");
            $('#email-js-message').css("display", "none");
            emailValid = true;
            if (nameValid && usernameValid && passwordValid && emailValid) {
                // if all inputs valid, make save button available
                $('#save').prop('disabled', false);
            }
        }
        else {  // invalid
            input.addClass("invalid");
            $('#email-js-message').css("display", "block");
            emailValid = false;
            $('#save').prop('disabled', true);
        }
    });

  });