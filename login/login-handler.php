<?php

    session_start();

    require_once '../Dao.php';
    $dao = new Dao();

    if ($_POST['username'] != "" && $_POST['password'] != "") {        
        $user = $dao->getUser($_POST['username']); 

        // check that a user was returned
        if ($user->rowCount() > 0) {

            // get an array of the user indexed by column name
            $userinfo = $user->fetch(PDO::FETCH_ASSOC);

            // check that the password entered and password returned match
            if($userinfo['Password'] == $_POST['password']) {
                $_SESSION['logged_in'] = true;    
                $_SESSION['id'] = $userinfo['ID'];
                $_SESSION['name'] = $userinfo['Name']; 
                $_SESSION['username'] = $userinfo['Username'];  
                $_SESSION['email'] = $userinfo['Email']; 
                header("Location: ../home/home.php");  
                exit();
            }
            else {
                $_SESSION['message'] = "Password and username do not match";
            }
        }
        else {
            $_SESSION['message'] = "Username does not match an account";
        }
    }{
        $_SESSION['message'] = "Please enter a username and password";
    }    

    $_SESSION['username'] = $_POST['username'];
    header("Location: ./login.php");  
    exit();

?>

