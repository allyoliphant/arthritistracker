$(function() { 

    var url = document.URL.split('/');
    var path = './' + url[url.length-2] + '/' + url[url.length-2] + '-handler.php';
    $("#url-input").val(path);

    $('#entry-form').validate({  // initialize the plugin
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

  });

