<?php
    session_start();

    require_once '../Dao.php';
    $dao = new Dao();

    $messages = array();
    $inputsValid = true;


    // check that all inputs have a value
    if ($_POST['side'] == "") {
        $messages[] = "Choose a side"; 
        $inputsValid = false;
    }
    if ($_POST['joint'] == "") {
        $messages[] = "Choose a joint"; 
        $inputsValid = false;
    }
    if ($_POST['pain'] == "") {
        $messages[] = "Choose a pain level"; 
        $inputsValid = false;
    }
    if ($_POST['date'] == "") {
        $messages[] = "Choose a date"; 
        $inputsValid = false;
    }
    if ($_POST['time'] == "") {
        $messages[] = "Choose a time"; 
        $inputsValid = false;
    }

    // inputs are valid
    if ($inputsValid) {
        // create user
        $dao->createEntry($_POST['side'], $_POST['joint'], $_POST['pain'], $_POST['date'], $_POST['time'], $_SESSION['user-id']);

        $messages[] = "Entry added!";
        $_SESSION['messages'] = $messages;
        $_SESSION['good'] = true;   
        header("Location: ./new-entry.php"); 
        exit(); 
    }
        
    $_SESSION['input'] = $_POST; 
    $_SESSION['messages'] = $messages;     
    header("Location: ./new-entry.php"); 
    exit();
?>