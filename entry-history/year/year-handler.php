<?php

    session_start();

    require_once '../../Dao.php';
    $dao = new Dao();

    $_SESSION['date'] = $_GET['date'];

    $entries = $dao->getEntryByMonth($_GET['date'], $_SESSION['userinfo']['ID']);
    
    if ($entries->rowCount() > 0) {
        $_SESSION['show'] = "show";        

        $_SESSION['entries'] = $entries->fetchAll(PDO::FETCH_ASSOC);

        $time1 = $dao->getEntryByMonth_TimeRange($_GET['date'], $_SESSION['userinfo']['ID'], '00:00:00', '05:59:59');
        $_SESSION['time1'] = $time1->fetchAll(PDO::FETCH_ASSOC);
        $time2 = $dao->getEntryByMonth_TimeRange($_GET['date'], $_SESSION['userinfo']['ID'], '06:00:00', '11:59:59');
        $_SESSION['time2'] = $time2->fetchAll(PDO::FETCH_ASSOC);
        $time3 = $dao->getEntryByMonth_TimeRange($_GET['date'], $_SESSION['userinfo']['ID'], '12:00:00', '17:59:59');
        $_SESSION['time3'] = $time3->fetchAll(PDO::FETCH_ASSOC);
        $time4 = $dao->getEntryByMonth_TimeRange($_GET['date'], $_SESSION['userinfo']['ID'], '18:00:00', '23:59:59');
        $_SESSION['time4'] = $time4->fetchAll(PDO::FETCH_ASSOC);

        $painStats = $dao->getPainStatsByMonth($_GET['date'], $_SESSION['userinfo']['ID']);
        $_SESSION['painStats'] = $painStats->fetch(PDO::FETCH_ASSOC);

        $jointCount = $dao->getJointCountByMonth($_GET['date'], $_SESSION['userinfo']['ID']);
        $_SESSION['jointCount'] = $jointCount->fetchAll(PDO::FETCH_ASSOC);
        if (count($_SESSION['jointCount']) == 1) {
            if($_SESSION['jointCount'][0]['Side'] == 'left') {
                $_SESSION['left'] = $_SESSION['jointCount'][0];
            } else {
                $_SESSION['right'] = $_SESSION['jointCount'][0];
            }
        } else {
            $_SESSION['left'] = $_SESSION['jointCount'][0];
            $_SESSION['right'] = $_SESSION['jointCount'][1];
        }
    }
    else {
        $_SESSION['error'] = "no-result";
    }   
         
    header("Location: ./month.php"); 
    exit();

?>