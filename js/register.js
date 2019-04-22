$(function() {
    
    var nameValid = /^(?=.*[a-zA-Z0-9])[a-zA-Z0-9\s]{1,30}$/.test($('#name').val());
    var usernameValid = /^[a-zA-Z0-9]{4,30}$/.test($('#username').val());
    var passwordValid = false;
    var emailValid = /^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9-\.]+\.[a-zA-Z0-9-]+$/.test($('#email').val());
    
    $('#register').prop('disabled', true);
    $('#name-js-message').css("display", "none");
    $('#username-js-message').css("display", "none");
    $('#password-js-message-length').css("display", "none");
    $('#password-js-message-number').css("display", "none");
    $('#password-js-message-letter').css("display", "none");
    $('#password-js-message-special').css("display", "none");
    $('#confirm-password-js-message').css("display", "none");
    $('#email-js-message').css("display", "none");


    $('#name').bind('propertychange keyup input cut paste', function() {
        var pattern = /^(?=.*[a-zA-Z0-9])[a-zA-Z0-9\s]{1,30}$/;
        var input=$(this);
        var name=pattern.test(input.val());
        if(name) {
            input.removeClass("invalid");
            $('#name-js-message').css("display", "none");
            nameValid = true;
            if (nameValid && usernameValid && passwordValid && emailValid) {
                $('#register').prop('disabled', false);
            }
        }
        else {
            input.addClass("invalid");
            $('#name-js-message').css("display", "block");
            nameValid = false;
            $('#register').prop('disabled', true);
        }
    });

    $('#username').bind('propertychange keyup input cut paste', function() {
        var pattern = /^[a-zA-Z0-9]{4,30}$/;
        var input=$(this);
        var username=pattern.test(input.val());
        if(username) {
            input.removeClass("invalid");
            $('#username-js-message').css("display", "none");
            usernameValid = true;
            if (nameValid && usernameValid && passwordValid && emailValid) {
                $('#register').prop('disabled', false);
            }
        }
        else {
            input.addClass("invalid");
            $('#username-js-message').css("display", "block");
            usernameValid = false;
            $('#register').prop('disabled', true);
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
            
            if(input.val() == $('#confirm-password').val()) {
                $('#confirm-password').removeClass("invalid");
                $('#confirm-password-js-message').css("display", "none");
                passwordValid = true;
                if (nameValid && usernameValid && passwordValid && emailValid) {
                    $('#register').prop('disabled', false);
                }
            }
            else {
                passwordValid = false;
                $('#register').prop('disabled', true);
            }
        }
        else {
            input.addClass("invalid");
            passwordValid = false;
            $('#register').prop('disabled', true);

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
        if ($('#confirm-password').val() != "") {
            if(input.val() == $('#confirm-password').val()) {
                $('#confirm-password').removeClass("invalid");
                $('#confirm-password-js-message').css("display", "none");
                passwordValid = true;
                if (nameValid && usernameValid && passwordValid && emailValid) {
                    $('#register').prop('disabled', false);
                }
            }
            else {
                $('#confirm-password').addClass("invalid");
                $('#confirm-password-js-message').css("display", "block");
                passwordValid = false;
                $('#register').prop('disabled', true);
            }
        }        
    });

    $('#confirm-password').bind('propertychange keyup input cut paste', function() {
        var input=$(this);
        if(input.val() == $('#password').val()) {
            input.removeClass("invalid");
            $('#confirm-password-js-message').css("display", "none");
            passwordValid = true;
            if (nameValid && usernameValid && passwordValid && emailValid) {
                $('#register').prop('disabled', false);
            }
        }
        else {
            input.addClass("invalid");
            $('#confirm-password-js-message').css("display", "block");
            passwordValid = false;
            $('#register').prop('disabled', true);
        }
    });

    $('#email').bind('propertychange keyup input cut paste', function() {
        var pattern = /^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9-\.]+\.[a-zA-Z0-9-]+$/;
        var input=$(this);
        var email=pattern.test(input.val());
        if(email) {
            input.removeClass("invalid");
            $('#email-js-message').css("display", "none");
            emailValid = true;
            if (nameValid && usernameValid && passwordValid && emailValid) {
                $('#register').prop('disabled', false);
            }
        }
        else {
            input.addClass("invalid");
            $('#email-js-message').css("display", "block");
            emailValid = false;
            $('#register').prop('disabled', true);
        }
    });

  });

