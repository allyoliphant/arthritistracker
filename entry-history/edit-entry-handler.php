<?php

    session_start();

    require_once '../Dao.php';
    $dao = new Dao();

    $inputsValid = true;
    $path = $_POST['path'];

    if ($_POST['side'] == "") {
        $inputsValid = false;
    }
    if ($_POST['joint'] == "") {
        $inputsValid = false;
    }
    if ($_POST['pain'] == "") { 
        $inputsValid = false;
    }
    if ($_POST['date'] == "") {
        $inputsValid = false;
    }
    if ($_POST['time'] == "") {
        $inputsValid = false;
    }

    // input is valid
    if ($inputsValid) {
        // edit entry
        $dao->editEntry($_POST['side'], $_POST['joint'], $_POST['pain'], $_POST['date'], $_POST['time'], $_POST['entry-id']);
  
        $_SESSION['edit-date'] = $_SESSION['date'];
        header("Location: ". $path); 
        exit(); 
    }
    
    header("Location: ". $path);
    exit();


?>