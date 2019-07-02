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
                echo "<td ";                
                if (isset($_SESSION[$time])) {
                    $count = 0;
                    $painSum = 0;
                    foreach($_SESSION[$time] as $entry) { 
                        if ($i < 10) {
                            $pattern = "/" . $date . "-0" . $i . "-[0-3][0-9]$/";
                        } else {
                            $pattern = "/" . $date . "-" . $i . "-[0-3][0-9]$/";
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

        public function xAxis($d) {
            $days = date("t", strtotime($d . "-23"));
            $arrayOfDays = array_fill(0, $days, 1);
            $i = 1;
            foreach($arrayOfDays as $day) {
                echo "<td class='x-axis'>" . $i . "</td>";
                $i = $i + 1;
            }
        }

        public function summaryTable($max) {
            $height = 400 / $max;

            for ($i = 1; $i <= $max; $i++) {
               echo "<tr style='height:{$height}px !important'>";

               //ankle
               echo $_SESSION['left']['Ankle'] >= $i ? "<td class='left-bar'></td>" :"<td></td>";
               echo ($_SESSION['right']['Ankle'] >= $i ? "<td class='right-bar'></td>" : "<td></td>");               
               
               echo "<td></td>";    

               //knee
               echo  ($_SESSION['left']['Knee'] >= $i ? "<td class='left-bar'></td>" : "<td></td>");
               echo ($_SESSION['right']['Knee'] >= $i ? "<td class='right-bar'></td>" : "<td></td>");        
               
               echo "<td></td>"; 

               //hip
               echo  ($_SESSION['left']['Hip'] >= $i ? "<td class='left-bar'></td>" : "<td></td>");
               echo  ($_SESSION['right']['Hip'] >= $i ? "<td class='right-bar'></td>" : "<td></td>");       
               
               echo "<td></td>";

               //hand
               echo  ($_SESSION['left']['Hand'] >= $i ? "<td class='left-bar'></td>" : "<td></td>");
               echo ($_SESSION['right']['Hand'] >= $i ? "<td class='right-bar'></td>" : "<td></td>");         
               
               echo "<td></td>";  

               //wrist
               echo  ($_SESSION['left']['Wrist'] >= $i ? "<td class='left-bar'></td>" : "<td></td>");
               echo ($_SESSION['right']['Wrist'] >= $i ? "<td class='right-bar'></td>" : "<td></td>");        
               
               echo "<td></td>"; 

               //elbow
               echo  ($_SESSION['left']['Elbow'] >= $i ? "<td class='left-bar'></td>" : "<td></td>");
               echo  ($_SESSION['right']['Elbow'] >= $i ? "<td class='right-bar'></td>" : "<td></td>");        
               
               echo "<td></td>"; 

               //shoulder
               echo  ($_SESSION['left']['Shoulder'] >= $i ? "<td class='left-bar'></td>" : "<td></td>");
               echo  ($_SESSION['right']['Shoulder'] >= $i ? "<td class='right-bar'></td>" : "<td></td>");   

               echo "</tr>";
            }
        }

    }
?>