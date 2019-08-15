<?php
    session_cache_limiter('public');
    session_start();

    include_once '../Dao.php';
    include_once '../Regx.php';
    $dao = new Dao();
    $regx = new Regx();

    if ($_POST['username'] != "" && $_POST['password'] != "") {  
        
        // check that the username and password entered are valid
        if ($regx->usernameValid($_POST['username']) && $regx->passwordValid($_POST['password'])) {
            $user = $dao->getUser($_POST['username'], $_POST['password']); 

            // check that one user was returned
            if ($user != null && $user->rowCount() == 1) {
                // get an array of the user indexed by column name
                $userinfo = $user->fetch(PDO::FETCH_ASSOC);
                $_SESSION['logged_in'] = true;    
                $_SESSION['user-name'] = $userinfo['Name'];  
                $_SESSION['username'] = $userinfo['Username'];
                $_SESSION['user-email'] = $userinfo['Email'];  
                $_SESSION['user-id'] = $userinfo['ID'];
                header("Location: ../home/home.php");  // login
                exit(); 
            }
            else {
                // no users or multiple users returned
                $_SESSION['message'] = "Username and password don't match";
            }
        }
        else {
            // username or password are not valid
            $_SESSION['message'] = "Username and password don't match";
        }        
    }
    else {
        // missing inputs
        $_SESSION['message'] = "Please enter username and password";
    }    

    $_SESSION['username'] = $_POST['username'];
    header("Location: ./login.php");  
    exit();
?>

