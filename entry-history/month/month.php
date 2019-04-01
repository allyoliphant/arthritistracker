<?php
	session_start();

	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$_SESSION['message'] = "Please login to view";
		header("Location: ../../login/login.php");
		exit();
	}

    require_once '../Entry.php';
    $e = new Entry();
?>

<html>
	<header>
		<title>arthritis tracker</title>
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
        <link rel="stylesheet" href="month.css">
	</header>		
	<body>
		<div class="sidenav">
            <a href="../../home/home.php"><img src="../../logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../year/year.php">by year</a>
            <a class="button current-page" href="../month/month.php">by month</a>
            <a class="button" href="../day/day.php">by day</a>
            <a class="button" id="account-nav-button" href="../../account/account.php">my account</a>
            <a class="button" href="../../logout/logout.php">logout</a>
		</div>	

		<div class="main">
            <h1>entry history</h1>

            <form method="GET" action="month-handler.php">
                <label>month:</label>
                <input type="month" name="date" min="1990-01"
                <?php
                    date_default_timezone_set('America/Boise');
                    $date = date("Y-m");
                    echo "max='{$date}'";
                    echo "value='{$date}'";                        
                ?>/>
                <input class="button" type="submit" value="view entries"/>
            </form>

            <div class="result <?php echo isset($_SESSION['show']) ? $_SESSION['show'] : ''; ?>">
                <div class="date"><b>History for: <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date'; ?></b></div>
                <table>
                    <tr>
                        <td id="top-y-value">12am</td>
                    </tr>
                    <tr>
                        <td class="y-axis">6pm</td>
                        <?php
                            $date = explode( '-', $_SESSION['date'] );
                            $days = cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]);
                            for ($i = 1; $i <= $days; $i++) {
                                $stuff = $e->getClassAndCount_Month('time4', $i);
                                $blank = ' ';
                                echo "<td class='" . $stuff[0] . "'>" . $stuff[1] . "</td>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td class="y-axis">12pm</td>
                        <?php
                            $date = explode( '-', $_SESSION['date'] );
                            $days = cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]);
                            for ($i = 1; $i <= $days; $i++) {
                                $stuff = $e->getClassAndCount_Month('time3', $i);
                                $blank = ' ';
                                echo "<td class='" . $stuff[0] . "'>" . $stuff[1] . "</td>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td class="y-axis">6am</td>
                        <?php
                            $date = explode( '-', $_SESSION['date'] );
                            $days = cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]);
                            for ($i = 1; $i <= $days; $i++) {
                                $stuff = $e->getClassAndCount_Month('time2', $i);
                                $blank = ' ';
                                echo "<td class='" . $stuff[0] . "'>" . $stuff[1] . "</td>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td class="y-axis">12am</td>
                        <?php
                            $date = explode( '-', $_SESSION['date'] );
                            $days = cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]);
                            for ($i = 1; $i <= $days; $i++) {
                                $stuff = $e->getClassAndCount_Month('time1', $i);
                                echo "<td class='" . $stuff[0] . "'>" . $stuff[1] . "</td>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td></td>
                        <?php
                            $date = explode( '-', $_SESSION['date'] );
                            $days = cal_days_in_month(CAL_GREGORIAN,$date[1],$date[0]);
                            for ($i = 1; $i <= $days; $i++) {
                                echo "<td class='x-axis'>" . $i . "</td>";
                            }
                        ?>
                    </tr>   
                </table>
                
                <div>
                    color: average pain level 
                        <span class="painOne key">1</span><span class="painTwo key">2</span><span class="painThree key">3</span><span class="painFour key">4</span><span class="painFive key">5</span>
                </div>      
                <div>
                    number: number of entries
                </div>
    
                <div class="summary">    
                    <div class="summary-section">
                        <div><b>pain level</b></div>
                        <span>average: <?php echo $_SESSION['painStats']['Avg']; ?></span>
                        <span>min: <?php echo $_SESSION['painStats']['Min']; ?></span>
                        <span>max: <?php echo $_SESSION['painStats']['Max']; ?></span>
                    </div>   
                    <div class="summary-section">
                        <div><b>left</b></div>
                        <span>ankle: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Ankle'] : 0; ?></span>
                        <span>knee: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Knee'] : 0; ?></span>
                        <span>hip: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Hip'] : 0; ?></span>
                        <span>hand: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Hand'] : 0; ?></span>
                        <span>wrist: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Wrist'] : 0; ?></span>
                        <span>elbow: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Elbow'] : 0; ?></span>
                        <span>shoulder: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Shoulder'] : 0; ?></span>
                    </div>
                    <div class="summary-section">
                        <div><b>right</b></div>
                        <span>ankle: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Ankle'] : 0; ?></span>
                        <span>knee: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Knee'] : 0; ?></span>
                        <span>hip: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Hip'] : 0; ?></span>
                        <span>hand: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Hand'] : 0; ?></span>
                        <span>wrist: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Wrist'] : 0; ?></span>
                        <span>elbow: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Elbow'] : 0; ?></span>
                        <span>shoulder: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Shoulder'] : 0; ?></span>
                    </div>
                </div>
            </div>   
            
            <div class="result <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''; ?>">
                No entries found for the month: <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date'; ?>
            </div>     
			
			<div class="footer">
				<hr/>
				arthritis tracker | Ally Oliphant | CS401
			</div>
		</div>
	</body>
</html>

<?php
unset($_SESSION['show']); 
unset($_SESSION['date']);
unset($_SESSION['time1']);
unset($_SESSION['time2']);
unset($_SESSION['time3']);
unset($_SESSION['time4']);
unset($_SESSION['painStats']);
unset($_SESSION['error']);
unset($_SESSION['left']);
unset($_SESSION['right']);
?>