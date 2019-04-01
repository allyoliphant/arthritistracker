<?php

    class Entry {

        public function getClassAndCount_Day($time, $side, $joint) {
            if (isset($_SESSION[$time])) {
                $count = 0;
                $painSum = 0;
                foreach($_SESSION[$time] as $entry) {
                    if ($entry['Side'] == $side && $entry['Joint'] == $joint) {
                        $count = $count + 1;
                        $painSum = $painSum + $entry['PainLevel'];
                    }
                }
                if ($count > 0) {
                    $painAvg = $painSum / $count;
                    if ($painAvg < 1.5) { echo "class='painOne'"; }
                    else if ($painAvg < 2.5) { echo "class='painTwo'"; }
                    else if ($painAvg < 3.5) { echo "class='painThree'"; }
                    else if ($painAvg < 4.5) { echo "class='painFour'"; }
                    else { echo "class='painFive'"; }
                }
            } 
            echo ">";
            echo $count>0 ? $count : '';
        }

        public function getClassAndCount_Month($time, $day) {
            if (isset($_SESSION[$time])) {
                $count = 0;
                $painSum = 0;
                foreach($_SESSION[$time] as $entry) { 
                    if ($day < 10) {
                        $pattern = "/.0" . $day . "$/";
                    } else {
                        $pattern = "/." . $day . "$/";
                    }    
                    if (preg_match($pattern, $entry['Date'])) {
                        $count = $count + 1;
                        $painSum = $painSum + $entry['PainLevel'];
                    }
                }
                if ($count > 0) {
                    $painAvg = $painSum / $count;
                    if ($painAvg < 1.5) { echo "class='painOne'"; }
                    else if ($painAvg < 2.5) { echo "class='painTwo'"; }
                    else if ($painAvg < 3.5) { echo "class='painThree'"; }
                    else if ($painAvg < 4.5) { echo "class='painFour'"; }
                    else { echo "class='painFive'"; }
                }
            } 
            echo ">";
            echo $count>0 ? $count : '';
        }

        public function xAxis($d) {
            $date = preg_split( "/-/", $d);
            $days = cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]);
            $arrayOfDays = array_fill(0, $days, 1);
            echo print_r($arrayOfDays, 1);
            $i = 1;
            foreach($arrayOfDays as $day) {
                echo "<td class='x-axis'>" . $i . "</td>";
                $i = $i + 1;
            }
        }

    }
?>