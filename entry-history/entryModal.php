<?php

    $entries = json_decode($_GET['entries'], true);
    $month = $_GET['date'];

    if ($month < 10) {
        $pattern = "/[0-9][0-9][0-9][0-9]-0" . $month . "-[0-3][0-9]$/";
    } else {
        $pattern = "/[0-9][0-9][0-9][0-9]-" . $month . "-[0-3][0-9]$/";
    } 
                
    foreach ($entries as $entry) {
        $e = [];
        if (preg_match($pattern, $entry['Date'])) {
            $e = array_push($e, $entry);
        }
    }

    $_SESSION['entryModal'] = $e;    

?>