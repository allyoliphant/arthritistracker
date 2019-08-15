<?php
    session_cache_limiter('public');
    session_start();

    require_once '../Dao.php';
    $dao = new Dao();

    $inputsValid = true;
    $path = $_POST['path'];

    // check that all inputs have a value
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

    // inputs are valid
    if ($inputsValid) {
        // edit entry
        $dao->editEntry($_POST['side'], $_POST['joint'], $_POST['pain'], $_POST['date'], $_POST['time'], $_POST['entry-id']);      
        
        $_SESSION['edit-date'] = $_SESSION['date'];
        unset($_SESSION['date']);
        unset($_SESSION['time1']);
        unset($_SESSION['time2']);
        unset($_SESSION['time3']);
        unset($_SESSION['time4']);
        header("Location: ". $path); 
        exit(); 
    }
    
    $_SESSION['edit-date'] = $_SESSION['date'];
    unset($_SESSION['date']);
    unset($_SESSION['time1']);
    unset($_SESSION['time2']);
    unset($_SESSION['time3']);
    unset($_SESSION['time4']);
    header("Location: ". $path); 
    exit(); 
?>