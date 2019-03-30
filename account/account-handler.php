<?php


    session_start();

    require_once '../Dao.php';
    require_once '../regx.php';
    $dao = new Dao();
    $regx = new RegX();

    $messages = array();
    $inputsValid = true;

    // check that all inputs are filled
    if ($_POST['name']=="" || $_POST['username']=="" || $_POST['password']=="" || $_POST['confirm-password']=="" || $_POST['email']=="") { 
        $messages[] = "Please fill out all fields"; 
        $inputsValid = false;        
    }
    // check that changes were made
    if ($_POST['name'] == $_SESSION['userinfo']['Name'] && $_POST['username'] == $_SESSION['userinfo']['Username'] && 
        $_POST['password'] == $_SESSION['userinfo']['Password'] && $_POST['confirm-password'] == $_SESSION['userinfo']['Password'] && 
        $_POST['email'] == $_SESSION['userinfo']['Email']) { 
        $messages[] = "No changes to be made"; 
        $inputsValid = false;        
    }
    // check if name fits the required pattern
    if ($_POST['name'] != $_SESSION['userinfo']['Name'] && $_POST['name'] != "" && !$regx->nameValid($_POST['name'])) {
        $messages[] = "name: at least one letter, max 30 characters, and contain only letters and spaces";
        $inputsValid = false; 
    }
    // check if username fits the required pattern
    if ($_POST['username'] != $_SESSION['userinfo']['Username'] && $_POST['username'] != "" && !$regx->usernameValid($_POST['username'])) {
        $messages[] = "username: 6 to 30 characters and contain only letters and numbers";
        $inputsValid = false; 
    }
    // check that username is not already taken
    if ($_POST['username'] != $_SESSION['userinfo']['Username'] && $_POST['username'] != "" && !$dao->usernameAvailable($_POST['username'])) {
        $messages[] = "Username is taken";
        $inputsValid = false; 
    }
    // check if the passwords fits the required pattern
    if (($_POST['password'] != $_SESSION['userinfo']['Password'] && $_POST['password'] != "" && !$regx->passwordValid($_POST['password'])) ||
        ($_POST['confirm-password'] != $_SESSION['userinfo']['Password'] && $_POST['confirm-password'] != "" && !$regx->passwordValid($_POST['confirm-password']))) {
        $messages[] = "password: 6 to 30 characters, and at least 1 letter, 1 number, and 1 special character (!, @, #, $, %, &, ?, -, _)";
        $inputsValid = false; 
    }
    // check that the passwords match
    if ($_POST['password'] !== $_POST['confirm-password']) {
        $messages[] = "Passwords do not match";
        $inputsValid = false; 
    }
    // check if email fits the required pattern
    if ($_POST['email'] != $_SESSION['userinfo']['Email'] && $_POST['email'] != "" && !$regx->emailValid($_POST['email'])) {
        $messages[] = "email: must be a valid email";
        $inputsValid = false; 
    }
    // check that email is not already in use
    if($_POST['email'] != $_SESSION['userinfo']['Email'] && $_POST['email'] != "" && !$dao->emailAvailable($_POST['email'])) {  
        $messages[] = "Email is already in use";
        $inputsValid = false; 
    }


    // input is valid
    if ($inputsValid) {
        // update user
        $dao->updateUser($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email'], $_SESSION['userinfo']['ID']);
                    
        $user = $dao->getUser($_POST['username']);
        $userinfo = $user->fetch(PDO::FETCH_ASSOC);
        
        $messages[] = "Account updated!";
        $_SESSION['messages'] = $messages; 
        $_SESSION['good'] = true; 
  
        $_SESSION['userinfo'] = $userinfo;  
        header("Location: ./account.php"); 
        exit(); 
    }      

        
    $_SESSION['input'] = $_POST; 
    $_SESSION['messages'] = $messages;  
    header("Location: ./account.php");  
    exit();

?>