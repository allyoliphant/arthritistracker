<?php

    session_start();

    require_once '../../Dao.php';
    require_once '../../Regx.php';
    $dao = new Dao();
    $regx = new Regx();

    $_SESSION['date'] = $_GET['date'];

    // check that something was entered and that it is a date
    if ($regx->dateValid($_GET['date'])) {

        $entries = $dao->getEntryByDay($_GET['date'], $_SESSION['userinfo']['ID']);
        
        if ($entries->rowCount() > 0) {
            $_SESSION['show'] = "show";        

            $_SESSION['entries'] = $entries->fetchAll(PDO::FETCH_ASSOC);

            $time1 = $dao->getEntryByDay_TimeRange($_GET['date'], $_SESSION['userinfo']['ID'], '00:00:00', '05:59:59');
            $_SESSION['time1'] = $time1->fetchAll(PDO::FETCH_ASSOC);
            $time2 = $dao->getEntryByDay_TimeRange($_GET['date'], $_SESSION['userinfo']['ID'], '06:00:00', '11:59:59');
            $_SESSION['time2'] = $time2->fetchAll(PDO::FETCH_ASSOC);
            $time3 = $dao->getEntryByDay_TimeRange($_GET['date'], $_SESSION['userinfo']['ID'], '12:00:00', '17:59:59');
            $_SESSION['time3'] = $time3->fetchAll(PDO::FETCH_ASSOC);
            $time4 = $dao->getEntryByDay_TimeRange($_GET['date'], $_SESSION['userinfo']['ID'], '18:00:00', '23:59:59');
            $_SESSION['time4'] = $time4->fetchAll(PDO::FETCH_ASSOC);

            $painStats = $dao->getPainStatsByDay($_GET['date'], $_SESSION['userinfo']['ID']);
            $_SESSION['painStats'] = $painStats->fetch(PDO::FETCH_ASSOC);
        }
        else {
            $_SESSION['error'] = "no-result";
        }  
    }
    else {
        $_SESSION['message'] = "Please enter a day - " . $_GET['date'];
    }     
         
    header("Location: ./day.php"); 
    exit();

?>