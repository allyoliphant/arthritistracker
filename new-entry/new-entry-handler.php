<?php

    session_start();

    require_once '../Dao.php';
    $dao = new Dao();

    $messages = array();
    $inputsValid = true;




    // input is valid
    if ($inputsValid) {
        // create user
        $dao->createEntry($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email']);

        $_SESSION['logged_in'] = true;  
        $_SESSION['good'] = true; 
        $_SESSION['userinfo'] = $userinfo;  
        header("Location: ./new-entry.php"); 
        exit(); 
    }      

        
    $_SESSION['input'] = $_POST; 
    $_SESSION['messages'] = $messages;     
    header("Location: ./new-entry.php"); 
    exit();

?>