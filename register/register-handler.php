<?php

    require_once '../Dao.php';
    $dao = new Dao();

    // check that the username hasn't been taken
    if($dao->checkIfAvailable($_POST['username'])) {

        // create user
        $dao->createUser($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email']);
        
        header("Location: ../home/home.php"); 
        exit();
    }
        
    header("Location: ./register.php"); 
    exit();

?>