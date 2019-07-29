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

        public function getClassAndCount_Month($time, $date) {
            $days = date("t", strtotime($date . "-23"));
            $arrayOfDays = array_fill(0, $days, 1);
            $i = 1;
            foreach($arrayOfDays as $day) {
                echo "<td ";                
                if (isset($_SESSION[$time])) {
                    $count = 0;
                    $painSum = 0;
                    foreach($_SESSION[$time] as $entry) { 
                        if ($i < 10) {
                            $pattern = "/.0" . $i . "$/";
                        } else {
                            $pattern = "/." . $i . "$/";
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
                echo "</td>";
                $i = $i + 1;
            }
        }

        public function getClassAndCount_Year($time, $date) {
            $months = array_fill(0, 12, 1);
            $i = 1;
            foreach($months as $month) {
                if ($i < 10) {
                    $pattern = "/" . $date . "-0" . $i . "-[0-3][0-9]$/";
                } else {
                    $pattern = "/" . $date . "-" . $i . "-[0-3][0-9]$/";
                }
                echo "<td ";                
                if (isset($_SESSION[$time])) {
                    $count = 0;
                    $painSum = 0;
                    foreach($_SESSION[$time] as $entry) { 
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
                echo "<a href='../entryModal.php' rel='ajax:modal' class='no-style-link' value='{$time} {$pattern}'>";
                echo "<input type='hidden' name='entry-value' value='{$time} {$pattern}'/>";
                echo $count>0 ? $count : '';
                echo "</a></td>";
                $i = $i + 1;
            }
        }

        public function xAxis($d) {
            $days = date("t", strtotime($d . "-23"));
            $arrayOfDays = array_fill(0, $days, 1);
            $i = 1;
            foreach($arrayOfDays as $day) {
                echo "<td class='x-axis'>";
                echo "<button value='" . $_SESSION['date'] . "-" . ($i < 10 ? "0".$i : $i) . "'";
                echo "type='submit' name='date'>{$i}</button></td>";
                $i = $i + 1;
            }
        }

        public function countBySide($side) {
            $count = 0;
            if (isset($_SESSION[$side])) {
                foreach ($_SESSION[$side] as $joint) {
                    $count += intval($joint);
                }
            }            
            return $count;
        }

        public function percentBySide() {
            $leftCount = $this->countBySide('left');
            $rightCount = $this->countBySide('right');
            
            $total = $leftCount + $rightCount;
            $percent = intval(($leftCount / $total) * 100);
            
            return $percent;
        }

        public function summaryJointTable($max, $entries, $side) {
            $w = round(550 / $max);
            for ($i = 0; $i < $entries; $i++) {
                echo "<td class='{$side}-bar' style='width: {$w}px !important'></td>";
            }
        }

        public function entryModal_Year($time, $month) {
            if ($month < 10) {
                $pattern = "/[0-9][0-9][0-9][0-9]-0" . $month . "-[0-3][0-9]$/";
            } else {
                $pattern = "/[0-9][0-9][0-9][0-9]-" . $month . "-[0-3][0-9]$/";
            } 
                           
            foreach ($_SESSION[$time] as $entry) {
                if (preg_match($pattern, $entry['Date'])) {
                    echo "<tr>";
                    echo "<td>" . $entry['Side'] . "</td>";
                    echo "<td> " . $entry['Joint'] . "</td>";
                    echo "<td>" . $entry['PainLevel'] . "</td>";
                    echo "<td>" . date_format(new DateTime($entry['Time']), 'g:ma') . "</td>";
                    echo "<td>" . date_format(new DateTime($entry['Date']), 'm/d/y') . "</td>";
                    echo "<td><a href='#entry-edit' rel='modal:open' class='no-style-link'>
                        <i class='material-icons' style='font-size:14px'>edit</i>
                        </a></td>";
                    echo "</tr>";
                }
            }            
        }

    }
?>