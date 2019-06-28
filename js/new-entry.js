$(function() {
    
    var date = new Date();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    console.log(date); 
    console.log(hours); 
    console.log(minutes); 
    


    $('#new-entry-form').validate({ // initialize the plugin
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
    
    $('#add-entry').prop('disabled', true);
    var sideValid = false;
    var jointValid = false;
    var painValid = false;
    var dateValid = true;
    var timeValid = true;

    $("[name='side']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='side']").valid() == true) {
            sideValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                $('#add-entry').prop('disabled', false);
            }
        } else {
            sideValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

    $("[name='joint']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='joint']").valid() == true) {
            jointValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                $('#add-entry').prop('disabled', false);
            }
        } else {
            jointValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

    $("[name='pain']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='pain']").valid() == true) {
            painValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                $('#add-entry').prop('disabled', false);
            }
        } else {
            painValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

    $("[name='date']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='date']").valid() == true) {
            dateValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                $('#add-entry').prop('disabled', false);
            }
        } else {
            dateValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

    $("[name='time']").bind('propertychange keyup input cut paste', function() {
        if ($("[name='time']").valid() == true) {
            timeValid = true;
            if (sideValid && jointValid && painValid && dateValid && timeValid) {
                $('#add-entry').prop('disabled', false);
            }
        } else {
            timeValid = false;
            $('#add-entry').prop('disabled', true);
        }
    });

  });

