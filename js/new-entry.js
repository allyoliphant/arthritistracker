$(function() { 
        
    // get current date and time for date and time inputs
    var date = new Date();  // current date and time
    var year = date.getFullYear();
    var month = date.getMonth() < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1);
    var day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
    var hour = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
    var minute = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
    $('#new-entry-date').val(year + '-' + month + '-' + day);  // set default date value to current date
    $('#new-entry-time').val(hour + ':' + minute);  // set default time value to current time


    $('#entry-form').validate({  // initialize the validation plugin
        rules: {
            side: {
                required: true
            },
            joint: {
                required: true
            },
            pain: {
                required: true
            },
            date: {
                required: true
            },
            time: {
                required: true
            }
        }
    });
    
    $('#add-entry').prop('disabled', true);  // disable add button

    var sideValid = false;  // input initially empty so invalid
    var jointValid = false;  // input initially empty so invalid
    var painValid = false;  // input initially empty so invalid
    var dateValid = true;  // set to current date so valid
    var timeValid = true;  // set to current time so valid

    // when side input changes, check new value if valid
    $("[name='side']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='side']").valid() == true) {
            sideValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                // if all inputs valid, make add button available
                $('#add-entry').prop('disabled', false);
            }
        } else {
            sideValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

    // when joint input changes, check new value if valid
    $("[name='joint']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='joint']").valid() == true) {
            jointValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                // if all inputs valid, make add button available
                $('#add-entry').prop('disabled', false);
            }
        } else {
            jointValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

    // when pain level input changes, check new value if valid
    $("[name='pain']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='pain']").valid() == true) {
            painValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                // if all inputs valid, make add button available
                $('#add-entry').prop('disabled', false);
            }
        } else {
            painValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

    // when date input changes, check new value if valid
    $("[name='date']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='date']").valid() == true) {
            dateValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                // if all inputs valid, make add button available
                $('#add-entry').prop('disabled', false);
            }
        } else {
            dateValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

    // when time input changes, check new value if valid
    $("[name='time']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='time']").valid() == true) {
            timeValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                // if all inputs valid, make add button available
                $('#add-entry').prop('disabled', false);
            }
        } else {
            timeValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

  });