<?php

    session_start();

    if ($_GET["answer"] == "yes")
    {
        session_destroy();
        header("Location: ../index.html");  
        exit();
    }
    else 
    {    
        // go to the previous page
        // header("location:javascript://history.go(-1)"); ??
        // or just stay on the page
        header("Location: logout.php");  
        exit();
    }