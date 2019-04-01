<?php

    session_start();

    require_once '../Dao.php';
    require_once '../Regx.php';
    $dao = new Dao();
    $regx = new Regx();

    if ($_POST['username'] != "" && $_POST['password'] != "") {  
        
        // check that the username and password entered are valid
        if ($regx->usernameValid($_POST['username']) && $regx->passwordValid($_POST['password'])) {
            $user = $dao->getUser($_POST['username']); 

            // check that one user was returned
            if ($user->rowCount() == 1) {

                // get an array of the user indexed by column name
                $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                // check that the password entered and password returned match
                if($userinfo['Password'] == $_POST['password']) {
                    $_SESSION['logged_in'] = true;    
                    $_SESSION['userinfo'] = $userinfo;
                    header("Location: ../home/home.php");  
                    exit();
                }
                else {
                    $_SESSION['message'] = "Username and password do not match";
                }
            }
            else {
                $_SESSION['message'] = "Username and password do not match";
            }
        }
        else {
            $_SESSION['message'] = "Username and password do not match";
        }        
    }
    else {
        $_SESSION['message'] = "Please enter an username and password";
    }    

    $_SESSION['username'] = $_POST['username'];
    header("Location: ./login.php");  
    exit();

?>

