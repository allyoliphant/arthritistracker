<?php

    require_once '../Dao.php';
    $dao = new Dao();

    $user = $dao->getUser($_POST['username']); 

    // check that a user was returned
    if ($user->rowCount() > 0) {

        // get an array of the user indexed by column name
        $userinfo = $user->fetch(PDO::FETCH_ASSOC);

        // check that the password entered and password returned match
        if($userinfo['Password'] == $_POST['password']) {
            header("Location: ../home/home.html");  
            exit();
        }
    }

    header("Location: ./login.html");  
    exit();
    ?>

