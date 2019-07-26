<?php

    session_start();

    require_once '../../Dao.php';
    require_once '../../Regx.php';
    $dao = new Dao();
    $regx = new Regx();

    $_SESSION['date'] = $_GET['date'];

    // check that something was entered and that it is a date
    if ($regx->dateValid($_GET['date'])) {

        $entries = $dao->getEntryByMonthOrYear($_GET['date'], $_SESSION['user-id']);
        
        if ($entries->rowCount() > 0) {
            $_SESSION['show'] = "show";        

            $_SESSION['entries'] = $entries->fetchAll(PDO::FETCH_ASSOC);

            $time1 = $dao->getEntryByMonthOrYear_TimeRange($_GET['date'], $_SESSION['user-id'], '00:00:00', '05:59:59');
            $_SESSION['time1'] = $time1->fetchAll(PDO::FETCH_ASSOC);
            setcookie('time1', json_encode($_SESSION['time1']), 0, "/");
            $time2 = $dao->getEntryByMonthOrYear_TimeRange($_GET['date'], $_SESSION['user-id'], '06:00:00', '11:59:59');
            $_SESSION['time2'] = $time2->fetchAll(PDO::FETCH_ASSOC);
            setcookie('time2', json_encode($_SESSION['time2']), 0, "/");
            $time3 = $dao->getEntryByMonthOrYear_TimeRange($_GET['date'], $_SESSION['user-id'], '12:00:00', '17:59:59');
            $_SESSION['time3'] = $time3->fetchAll(PDO::FETCH_ASSOC);
            setcookie('time3', json_encode($_SESSION['time3']), 0, "/");
            $time4 = $dao->getEntryByMonthOrYear_TimeRange($_GET['date'], $_SESSION['user-id'], '18:00:00', '23:59:59');
            $_SESSION['time4'] = $time4->fetchAll(PDO::FETCH_ASSOC);
            setcookie('time4', json_encode($_SESSION['time4']), 0, "/");

            $painStats = $dao->getPainStatsByMonthOrYear($_GET['date'], $_SESSION['user-id']);
            $_SESSION['painStats'] = $painStats->fetch(PDO::FETCH_ASSOC);

            $jointCount = $dao->getJointCountByMonthOrYear($_GET['date'], $_SESSION['user-id']);
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
            
            $maxJointCount = $dao->getMaxJointCountByMonthOrYear($_GET['date'], $_SESSION['user-id']);
            $_SESSION['maxJointCount'] = $maxJointCount->fetchAll(PDO::FETCH_ASSOC)[0]['MaxEntries'];
        }
        else {
            $_SESSION['error'] = "no-result";
        }   
    }
    else {        
        $_SESSION['message'] = "Please enter a year";
    }
         
    header("Location: ./year.php"); 
    exit();

?>