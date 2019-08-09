<?php

    // Class to help build repeated portions of entry history
    class Entry {

        // echo the pain level class and count for each joint for history by day
        public function getClassAndCount_Day($time) {
            if (isset($_SESSION[$time])) {
                $joints = array('ankle', 'knee', 'hip', 'hand', 'wrist', 'elbow', 'shoulder');
                $sides = array('left', 'right');

                // repeat for each joint and side
                foreach($joints as $joint) {
                    foreach($sides as $side) {
                        echo "<td ";
                        $count = 0;
                        $painSum = 0;

                        // get the number of entries for the joint and time
                        foreach($_SESSION[$time] as $entry) {
                            if ($entry['Side'] == $side && $entry['Joint'] == $joint) {
                                $count = $count + 1;
                                $painSum = $painSum + $entry['PainLevel'];
                            }
                        }

                        // echo the pain level class based on the average pain level
                        // the pain level class determines the background color of the point
                        if ($count > 0) {
                            $painAvg = $painSum / $count;
                            if ($painAvg < 1.5) { echo "class='painOne'"; }
                            else if ($painAvg < 2.5) { echo "class='painTwo'"; }
                            else if ($painAvg < 3.5) { echo "class='painThree'"; }
                            else if ($painAvg < 4.5) { echo "class='painFour'"; }
                            else { echo "class='painFive'"; }
                        }

                        echo ">";
                        
                        // if there are entries for the point
                        if ($count > 0) {
                            // stuff to view and edit the entries that make up the point on the graph 
                            echo "<a href='/entry-history/entryModal.php' rel='ajax:modal' class='no-style-link' value='{$time} {$side} {$joint}'>";
                            echo "<input type='hidden' name='entry-value' value='{$time} {$side} {$joint}'/>";
                            
                            // displaying the count or nothing if there is no entries for the point
                            echo $count;  
    
                            echo "</a>";
                        }

                        echo "</td>";
                    }
                }
            }            
        }

        // echo the pain level class and count for each joint for history by month
        public function getClassAndCount_Month($time) {
            $month = isset($_SESSION['date']) ? $_SESSION['date'] : '0000';
            
            //get the number of days in the month
            $days = range(1, date("t", strtotime($month . "-23")));
            
            // for each day in the month, echo the pain level class and count if there are entries
            foreach($days as $day) {
                if ($day < 10) {
                    $pattern = "/.0" . $day . "$/";
                } else {
                    $pattern = "/." . $day . "$/";
                } 
                echo "<td ";                
                if (isset($_SESSION[$time])) {
                    $count = 0;
                    $painSum = 0;

                    // get the number of entries for the day and time
                    foreach($_SESSION[$time] as $entry) {                            
                        if (preg_match($pattern, $entry['Date'])) {
                            $count = $count + 1;
                            $painSum = $painSum + $entry['PainLevel'];
                        }
                    }

                    // echo the pain level class based on the average pain level
                    // the pain level class determines the background color of the point
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

                // if there are entries for the point
                if ($count > 0) {
                    // stuff to view and edit the entries that make up the point on the graph 
                    echo "<a href='/entry-history/entryModal.php' rel='ajax:modal' class='no-style-link' value='{$time} {$pattern}'>";
                    echo "<input type='hidden' name='entry-value' value='{$time} {$pattern}'/>";
                    
                    // displaying the count or nothing if there is no entries for the point
                    echo $count;  

                    echo "</a>";
                }

                echo "</td>";
            }
        }

        // echo the pain level class and count for each joint for history by year
        public function getClassAndCount_Year($time) {
            $months = range(1, 12);
            $year = isset($_SESSION['date']) ? $_SESSION['date'] : '0000';

            // for each month, echo the pain level class and count if there are entries
            foreach($months as $month) {
                if ($month < 10) {
                    $pattern = "/" . $year . "-0" . $month . "-[0-3][0-9]$/";
                } else {
                    $pattern = "/" . $year . "-" . $month . "-[0-3][0-9]$/";
                }
                echo "<td ";                
                if (isset($_SESSION[$time])) {
                    $count = 0;
                    $painSum = 0;

                    // get the number of entries for the month and time
                    foreach($_SESSION[$time] as $entry) { 
                        if (preg_match($pattern, $entry['Date'])) {
                            $count = $count + 1;
                            $painSum = $painSum + $entry['PainLevel'];
                        }
                    }

                    // echo the pain level class based on the average pain level
                    // the pain level class determines the background color of the point
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

                // if there are entries for the point
                if ($count > 0) {
                    // stuff to view and edit the entries that make up the point on the graph 
                    echo "<a href='/entry-history/entryModal.php' rel='ajax:modal' class='no-style-link' value='{$time} {$pattern}'>";
                    echo "<input type='hidden' name='entry-value' value='{$time} {$pattern}'/>";
                    
                    // displaying the count or nothing if there is no entries for the point
                    echo $count;  

                    echo "</a>";
                }

                echo "</td>";
            }
        }

        // create the x-axis for the graph in entry history by month
        public function xAxis_Month() {
            //get the number of days in the month
            $days = range(1, date("t", strtotime($_SESSION['date'] . "-23")));

            // for each day in the month
            foreach($days as $day) {
                echo "<td class='x-axis'>";

                // link to entry history by day
                echo "<button value='" . $_SESSION['date'] . "-" . ($day < 10 ? "0".$day : $day) . "'";
                echo "type='submit' name='date'>{$day}</button>";
                
                echo "</td>";
            }
        }

        // count the number of entries for a side
        // for the number of entries by side graph
        public function countBySide($side) {
            $count = 0;
            if (isset($_SESSION[$side])) {
                foreach ($_SESSION[$side] as $joint) {
                    $count += intval($joint);
                }
            }            
            return $count;
        }

        // get the percentage of entries for the left side
        // for the number of entries by side graph
        public function leftPercent() {
            $leftCount = $this->countBySide('left');
            $rightCount = $this->countBySide('right');
            
            $total = $leftCount + $rightCount;
            $percent = intval(($leftCount / $total) * 100);
            
            return $percent;
        }

        // echo number of entries and build bar for each side of provided joint
        public function summaryJointTable($joint) {
            // width of each count in the bars (so the bar part of the graph is always 550px or less)
            $w = round(550 / (isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 1));            

            //left side
            $leftCount = isset($_SESSION['left']) ? $_SESSION['left'][$joint] : 0;
            echo "<td class='y-axis fixed-side'>";
            echo $leftCount;
            echo "</td>";
            // build the bar graph for the left side
            for ($i = 0; $i < $leftCount; $i++) {
                echo "<td class='left-bar' style='width: {$w}px !important'></td>";
            }

            echo "</tr>";
            echo "<tr>";

            //right side
            $rightCount = isset($_SESSION['right']) ? $_SESSION['right'][$joint] : 0;
            echo "<td class='y-axis fixed-side'>";
            echo $rightCount;
            echo "</td>";
            // build the bar graph for the right side
            for ($i = 0; $i < $rightCount; $i++) {
                echo "<td class='right-bar' style='width: {$w}px !important'></td>";
            }
        }
    }
?>