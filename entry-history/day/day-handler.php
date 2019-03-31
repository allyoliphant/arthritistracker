<?php

    session_start();

    require_once '../../Dao.php';
    $dao = new Dao();

    $_SESSION['date'] = $_GET['date'];

    $entries = $dao->getEntryByDay($_GET['date'], $_SESSION['userinfo']['ID']);
    
    if ($entries->rowCount() > 0) {
        $_SESSION['show'] = "show";        
        $_SESSION['entries'] = $entries->fetchAll(PDO::FETCH_ASSOC);

        $painStats = $dao->getPainStatsByDay($_GET['date'], $_SESSION['userinfo']['ID']);
        $_SESSION['painStats'] = $painStats->fetch(PDO::FETCH_ASSOC);
    }
    else {
        $_SESSION['error'] = "no-result";
    }   
         
    header("Location: ./day.php"); 
    exit();

?>