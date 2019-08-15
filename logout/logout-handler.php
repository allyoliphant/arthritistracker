<?php
    session_cache_limiter('public');
    session_start();

    if ($_GET["answer"] == "yes")
    {
        session_destroy();
        header("Location: ../index.html");  // logout
        exit();
    }
?>