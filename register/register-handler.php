<?php
    session_start();

    require_once '../Dao.php';
    require_once '../Regx.php';
    $dao = new Dao();
    $regx = new Regx();

    $messages = array();
    $inputsValid = true;

    // check that all inputs are valid    
    // check that all inputs are filled
    if ($_POST['name']=="" || $_POST['username']=="" || $_POST['password']=="" || $_POST['confirm-password']=="" || $_POST['email']=="") { 
        $messages[] = "Please fill out all fields"; 
        $inputsValid = false;        
    }
    // check if name fits the required pattern
    if ($_POST['name'] != "" && !$regx->nameValid($_POST['name'])) {
        $messages[] = "name: at least one letter or number, max 30 characters, and contain only letters, numbers, and spaces";
        $inputsValid = false; 
    }
    // check if username fits the required pattern
    if ($_POST['username'] != "" && !$regx->usernameValid($_POST['username'])) {
        $messages[] = "username: 4 to 30 characters and contain only letters and numbers";
        $inputsValid = false; 
    }
    // check that username is not already taken
    if($_POST['username'] != "" && !$dao->usernameAvailable($_POST['username'], -1)) {
        $messages[] = "Username is taken";
        $inputsValid = false; 
    }
    // check if the passwords fits the required pattern
    if ($_POST['password'] != "" && !$regx->passwordValid($_POST['password']) ||
        $_POST['confirm-password'] != "" && !$regx->passwordValid($_POST['confirm-password'])) {
        $messages[] = "password: 6+ characters, and at least 1 letter, 1 number, and 1 special character (!, @, #, $, %, &, ?, -, _)";
        $inputsValid = false; 
    }
    // check that the passwords match
    if ($_POST['password'] !== $_POST['confirm-password']) {
        $messages[] = "Passwords do not match";
        $inputsValid = false; 
    }
    // check if email fits the required pattern
    if ($_POST['email'] != "" && !$regx->emailValid($_POST['email'])) {
        $messages[] = "email: must be a valid email";
        $inputsValid = false; 
    }
    // check that email is not already in use
    if($_POST['email'] != "" && !$dao->emailAvailable($_POST['email'])) {  
        $messages[] = "Email is already in use";
        $inputsValid = false; 
    }

    // inputs are valid
    if ($inputsValid) {
        // create user
        $dao->createUser($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email']);
                    
        // get the created user
        $user = $dao->getUser($_POST['username'], $_POST['password']);
        $userinfo = $user->fetch(PDO::FETCH_ASSOC);

        $_SESSION['logged_in'] = true;  
        $_SESSION['good'] = true; 
        $_SESSION['user-name'] = $userinfo['Name'];  
        $_SESSION['username'] = $userinfo['Username'];
        $_SESSION['user-email'] = $userinfo['Email'];  
        $_SESSION['user-id'] = $userinfo['ID'];    
        header("Location: ../home/home.php"); 
        exit(); 
    }   
        
    $_SESSION['input'] = $_POST; 
    $_SESSION['messages'] = $messages;     
    header("Location: ./register.php"); 
    exit();
?>