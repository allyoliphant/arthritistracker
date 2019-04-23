<?php


    session_start();

    require_once '../Dao.php';
    require_once '../Regx.php';
    $dao = new Dao();
    $regx = new Regx();

    $messages = array();
    $inputsValid = true;

    // check that all inputs are filled
    if ($_POST['name']=="" || $_POST['username']=="" || $_POST['password']=="" || $_POST['confirm-password']=="" || $_POST['email']=="") { 
        $messages[] = "Please fill out all fields"; 
        $inputsValid = false;        
    }
    // check that changes were made
    if ($_POST['name'] == $_SESSION['user-name'] && $_POST['username'] == $_SESSION['username'] &&  
        $_POST['email'] == $_SESSION['user-email']) { 
        $messages[] = "No changes to be made"; 
        $inputsValid = false;        
    }
    // check if name fits the required pattern
    if ($_POST['name'] != $_SESSION['user-name'] && $_POST['name'] != "" && !$regx->nameValid($_POST['name'])) {
        $messages[] = "name: at least one letter or number, max 30 characters, and contain only letters, numbers, and spaces";
        $inputsValid = false; 
    }
    // check if username fits the required pattern
    if ($_POST['username'] != $_SESSION['username'] && $_POST['username'] != "" && !$regx->usernameValid($_POST['username'])) {
        $messages[] = "username: 4 to 30 characters and contain only letters and numbers";
        $inputsValid = false; 
    }
    // check that username is not already taken
    if ($_POST['username'] != $_SESSION['username'] && $_POST['username'] != "" && !$dao->usernameAvailable($_POST['username'], $_SESSION['user-id'])) {
        $messages[] = "Username is taken";
        $inputsValid = false; 
    }
    // check if the passwords fits the required pattern
    if (($_POST['password'] != "" && !$regx->passwordValid($_POST['password'])) || 
        ($_POST['confirm-password'] != "" && !$regx->passwordValid($_POST['confirm-password']))) {
        $messages[] = "password: 6+ characters, and at least 1 letter, 1 number, and 1 special character (!, @, #, $, %, &, ?, -, _)";
        $inputsValid = false; 
    }
    // check that the passwords match
    if ($_POST['password'] !== $_POST['confirm-password']) {
        $messages[] = "Passwords do not match";
        $inputsValid = false; 
    }
    // check if email fits the required pattern
    if ($_POST['email'] != $_SESSION['user-email'] && $_POST['email'] != "" && !$regx->emailValid($_POST['email'])) {
        $messages[] = "email: must be a valid email";
        $inputsValid = false; 
    }
    // check that email is not already in use
    if($_POST['email'] != $_SESSION['user-email'] && $_POST['email'] != "" && !$dao->emailAvailable($_POST['email'])) {  
        $messages[] = "Email is already in use";
        $inputsValid = false; 
    }


    // input is valid
    if ($inputsValid) {
        // update user
        $dao->updateUser($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email'], $_SESSION['user-id']);
                    
        $user = $dao->getUser($_POST['username'], $_POST['password']);
        $userinfo = $user->fetch(PDO::FETCH_ASSOC);
        
        $messages[] = "Account updated!";
        $_SESSION['messages'] = $messages; 
        $_SESSION['good'] = true; 
  
        $_SESSION['user-name'] = $userinfo['Name'];  
        $_SESSION['username'] = $userinfo['Username'];
        $_SESSION['user-email'] = $userinfo['Email'];  
        $_SESSION['user-id'] = $userinfo['ID'];  
        header("Location: ./account.php"); 
        exit(); 
    }      

        
    $_SESSION['input'] = $_POST; 
    $_SESSION['messages'] = $messages;  
    header("Location: ./account.php");  
    exit();

?>