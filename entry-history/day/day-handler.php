<?php
    session_cache_limiter('public');
    session_start();

    require_once '../../Dao.php';
    require_once '../../Regx.php';
    $dao = new Dao();
    $regx = new Regx();

    $_SESSION['date'] = isset($_SESSION['edit-date']) ? $_SESSION['edit-date'] : $_GET['date'];
    unset($_SESSION['edit-date']);
    $date = $_SESSION['date'];

    // check that something was entered and that it is a date
    if ($regx->dateValid($date)) {

        // all the entries for the user on the date
        $entries = $dao->getEntryByDay($date, $_SESSION['user-id']);
        
        // check if entries were returned
        if ($entries->rowCount() > 0) {
            $_SESSION['show'] = "show";        

            $_SESSION['entries'] = $entries->fetchAll(PDO::FETCH_ASSOC);

            // sort the enteries by time range
            $time1 = [];
            $time2 = [];
            $time3 = [];
            $time4 = [];
            foreach($_SESSION['entries'] as $entry) {
                if (str_replace(':', '', $entry['Time']) >= '180000' ) {
                    array_push($time4, $entry);
                } 
                else if (str_replace(':', '', $entry['Time']) >= '120000' ) {
                    array_push($time3, $entry);
                } 
                else if (str_replace(':', '', $entry['Time']) >= '60000' ) {
                    array_push($time2, $entry);
                }
                else {
                    array_push($time1, $entry);
                }
            }
            $_SESSION['time1'] = $time1;
            $_SESSION['time2'] = $time2;
            $_SESSION['time3'] = $time3;
            $_SESSION['time4'] = $time4;

            // get the pain stats for the day
            $painStats = $dao->getPainStatsByDay($date, $_SESSION['user-id']);
            $_SESSION['painStats'] = $painStats->fetch(PDO::FETCH_ASSOC);

            // get the joint count by side for the day
            $jointCount = $dao->getJointCountByDay($date, $_SESSION['user-id']);
            $jc = $jointCount->fetchAll(PDO::FETCH_ASSOC);
            if (count($jc) == 1) {
                if($jc[0]['Side'] == 'left') {
                    $_SESSION['left'] = $jc[0];
                } else {
                    $_SESSION['right'] = $jc[0];
                }
            } else {
                $_SESSION['left'] = $jc[0];
                $_SESSION['right'] = $jc[1];
            }
        }
        else {
            // no entries for the day
            $_SESSION['error'] = "no-result";
        }  
    }
    else {
        // invalid date entered
        $_SESSION['message'] = "Please enter a day - " . $date;
    }     
         
    header("Location: ./day.php"); 
    exit();
?>