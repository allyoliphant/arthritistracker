<?php

    session_start();

    require_once '../Dao.php';
    $dao = new Dao();

    if ($_POST['name'] != "" && $_POST['username'] != "" && $_POST['password'] != "" 
        && $_POST['confirm-password'] != "" && $_POST['email'] != "") {    
        // check that the email isn't already used
        if($dao->emailAvailable($_POST['email'])) {        
            // check that the username hasn't been taken
            if($dao->usernameAvailable($_POST['username'])) {
                // check that the passwords match
                if ($_POST['password'] === $_POST['confirm-password']) {
                    // create user
                    $dao->createUser($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email']);
                    
                    $user = $dao->getUser($_POST['username']);
                    $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                    $_SESSION['logged_in'] = true;  
                    $_SESSION['id'] = $userinfo['ID'];       
                    $_SESSION['name'] = $_POST['name']; 
                    $_SESSION['username'] = $_POST['username'];  
                    $_SESSION['email'] = $_POST['email']; 
                    header("Location: ../home/home.php"); 
                    exit();
                }
                else { 
                    $_SESSION['message'] = "Passwords do not match";
                }        
            }
            else {        
                $_SESSION['message'] = "Username is taken";
            }
        }
        else {        
            $_SESSION['message'] = "Email is already in use";
        }           
    }
    else {        
        $_SESSION['message'] = "Please fill out all fields";
    }
        
    $_SESSION['error'] = true;  
    $_SESSION['name'] = $_POST['name']; 
    $_SESSION['username'] = $_POST['username'];  
    $_SESSION['email'] = $_POST['email'];      
    header("Location: ./register.php"); 
    exit();

?>