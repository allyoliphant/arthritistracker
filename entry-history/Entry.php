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
            $height = $max / 100;

            for ($i = $max; $i > 0; $i--) {
               echo "<tr>";

               //ankle
               echo $_SESSION['left']['Ankle'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['left']['Ankle'] . "</td>" 
                : ($_SESSION['left']['Ankle'] >= $i ? "<td style='height={$height}% !important' class='left-bar'>&nbsp;</td>" :"<td style='height={$height}% !important'>&nbsp;</td>");
               echo $_SESSION['right']['Ankle'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['right']['Ankle'] . "</td>" 
                : ($_SESSION['right']['Ankle'] >= $i ? "<td style='height={$height}% !important' class='right-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");               
               
               echo "<td>&nbsp;</td>";    

               //knee
               echo $_SESSION['left']['Knee'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['left']['Knee'] . "</td>" 
                : ($_SESSION['left']['Knee'] >= $i ? "<td style='height={$height}% !important' class='left-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");
               echo $_SESSION['right']['Knee'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['right']['Knee'] . "</td>" 
                : ($_SESSION['right']['Knee'] >= $i ? "<td style='height={$height}% !important' class='right-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");        
               
               echo "<td>&nbsp;</td>"; 

               //hip
               echo $_SESSION['left']['Hip'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['left']['Hip'] . "</td>" 
                : ($_SESSION['left']['Hip'] >= $i ? "<td style='height={$height}% !important' class='left-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");
               echo $_SESSION['right']['Hip'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['right']['Hip'] . "</td>" 
                : ($_SESSION['right']['Hip'] >= $i ? "<td style='height={$height}% !important' class='right-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");       
               
               echo "<td>&nbsp;</td>";

               //hand
               echo $_SESSION['left']['Hand'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['left']['Hand'] . "</td>" 
                : ($_SESSION['left']['Hand'] >= $i ? "<td style='height={$height}% !important' class='left-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");
               echo $_SESSION['right']['Hand'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['right']['Hand'] . "</td>" 
                : ($_SESSION['right']['Hand'] >= $i ? "<td style='height={$height}% !important' class='right-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");         
               
               echo "<td>&nbsp;</td>";  

               //wrist
               echo $_SESSION['left']['Wrist'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['left']['Wrist'] . "</td>" 
                : ($_SESSION['left']['Wrist'] >= $i ? "<td style='height={$height}% !important' class='left-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");
               echo $_SESSION['right']['Wrist'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['right']['Wrist'] . "</td>" 
                : ($_SESSION['right']['Wrist'] >= $i ? "<td style='height={$height}% !important' class='right-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");        
               
               echo "<td>&nbsp;</td>"; 

               //elbow
               echo $_SESSION['left']['Elbow'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['left']['Elbow'] . "</td>" 
                : ($_SESSION['left']['Elbow'] >= $i ? "<td style='height={$height}% !important' class='left-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");
               echo $_SESSION['right']['Elbow'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['right']['Elbow'] . "</td>" 
                : ($_SESSION['right']['Elbow'] >= $i ? "<td style='height={$height}% !important' class='right-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");        
               
               echo "<td>&nbsp;</td>"; 

               //shoulder
               echo $_SESSION['left']['Shoulder'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['left']['Shoulder'] . "</td>" 
                : ($_SESSION['left']['Shoulder'] >= $i ? "<td style='height={$height}% !important' class='left-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");
               echo $_SESSION['right']['Shoulder'] == $i - 1 ? "<td style='height={$height}% !important'>" . $_SESSION['right']['Shoulder'] . "</td>" 
                : ($_SESSION['right']['Shoulder'] >= $i ? "<td style='height={$height}% !important' class='right-bar'>&nbsp;</td>" : "<td style='height={$height}% !important'>&nbsp;</td>");   

               echo "</tr>";
            }
        }

    }
?>