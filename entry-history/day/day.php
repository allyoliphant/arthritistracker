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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
        <link rel="stylesheet" href="day.css">
        <script src="../../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../../js/jquery.validate.min.js"></script>
        <script src="../../js/footer.js"></script>
        <script src="../../js/entry-history.js"></script>
        <script src="../../js/mobile.js"></script>
	</header>		
	<body>
		<div class="side nav">
            <a href="../../home/home.php"><img src="../../logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../year/year.php">year</a>
            <a class="button" href="../month/month.php">month</a>
            <a class="button current-page" href="../day/day.php">day</a>
            <a class="button" id="account-nav-button" href="../../account/account.php">my account</a>
            <a class="button" href="../../logout/logout.php">logout</a>
		</div>	
		<div class="mobile nav">	
            <a href="../../home/home.php"><img id="mobile-logo" src="../../logo.png" width="40px" height="40px"/></a>	
			<div id="menuToggle">	
				<input type="checkbox" />			
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>	
		<div class="mobile-menu">
			<a class="mobile-btn" href="../../new-entry/new-entry.php">New Entry</a>
			<p id="history-section-title">entry history</p>
			<a class="mobile-btn" href="../../entry-history/year/year.php">year</a>
			<a class="mobile-btn" href="../../entry-history/month/month.php">month</a>
			<a class="mobile-btn current-page" href="../../entry-history/day/day.php">day</a>
			<a class="mobile-btn" id="account-nav-button" href="../../account/account.php">account</a>
			<a class="mobile-btn" href="../../logout/logout.php">logout</a>
		</div>

		<div class="main">
            <h1>entry history by day</h1>

            <form id="history-from" method="GET" action="day-handler.php">                
                <label>day:</label>
                <input type="date" name="date" min="1990-01-01" required
                <?php
                    date_default_timezone_set('America/Boise');
                    $date = date("Y-m-d");
                    echo "max='{$date}'";
                    $day = isset($_SESSION['date']) ? $_SESSION['date'] : $date;
                    echo "value='{$day}'";                        
                ?>/> 
                <input id="get-history" class="button" type="submit" value="view entries"/>
            </form>

            <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='error message'>" . $_SESSION['message'] . "</div>";
                }
                unset($_SESSION['message']);
            ?>

            <div class="result <?php echo isset($_SESSION['show']) ? $_SESSION['show'] : ''; ?>">
                <div class="date"><b>History for the day: <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date'; ?></b></div>
                <div class="entry-table">
                    <table>
                        <tr>
                            <td id="top-y-value">12am</td>
                        </tr>
                        <tr>
                            <td class="y-axis">6pm</td>
                            <td <?php $e->getClassAndCount_Day('time4', 'left', 'ankle') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'right', 'ankle') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'left', 'knee') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'right', 'knee') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'left', 'hip') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'right', 'hip') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'left', 'hand') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'right', 'hand') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'left', 'wrist') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'right', 'wrist') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'left', 'elbow') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'right', 'elbow') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'left', 'shoulder') ?></td>
                            <td <?php $e->getClassAndCount_Day('time4', 'right', 'shoulder') ?></td>
                        </tr>
                        <tr>
                            <td class="y-axis">12pm</td>
                            <td <?php $e->getClassAndCount_Day('time3', 'left', 'ankle') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'right', 'ankle') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'left', 'knee') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'right', 'knee') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'left', 'hip') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'right', 'hip') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'left', 'hand') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'right', 'hand') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'left', 'wrist') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'right', 'wrist') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'left', 'elbow') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'right', 'elbow') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'left', 'shoulder') ?></td>
                            <td <?php $e->getClassAndCount_Day('time3', 'right', 'shoulder') ?></td>
                        </tr>
                        <tr>
                            <td class="y-axis">6am</td>
                            <td <?php $e->getClassAndCount_Day('time2', 'left', 'ankle') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'right', 'ankle') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'left', 'knee') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'right', 'knee') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'left', 'hip') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'right', 'hip') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'left', 'hand') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'right', 'hand') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'left', 'wrist') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'right', 'wrist') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'left', 'elbow') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'right', 'elbow') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'left', 'shoulder') ?></td>
                            <td <?php $e->getClassAndCount_Day('time2', 'right', 'shoulder') ?></td>
                        </tr>
                        <tr>
                            <td class="y-axis">12am</td>
                            <td <?php $e->getClassAndCount_Day('time1', 'left', 'ankle') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'right', 'ankle') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'left', 'knee') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'right', 'knee') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'left', 'hip') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'right', 'hip') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'left', 'hand') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'right', 'hand') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'left', 'wrist') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'right', 'wrist') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'left', 'elbow') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'right', 'elbow') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'left', 'shoulder') ?></td>
                            <td <?php $e->getClassAndCount_Day('time1', 'right', 'shoulder') ?></td>                        
                        </tr>
                        <tr>
                            <td></td>
                            <td class="x-axis">left</td>
                            <td class="x-axis">right</td>
                            <td class="x-axis">left</td>
                            <td class="x-axis">right</td>
                            <td class="x-axis">left</td>
                            <td class="x-axis">right</td>
                            <td class="x-axis">left</td>
                            <td class="x-axis">right</td>
                            <td class="x-axis">left</td>
                            <td class="x-axis">right</td>
                            <td class="x-axis">left</td>
                            <td class="x-axis">right</td>
                            <td class="x-axis">left</td>
                            <td class="x-axis">right</td>
                        </tr>   
                        <tr>
                            <td></td>
                            <td colspan="2">ankle</td>
                            <td colspan="2">knee</td>
                            <td colspan="2">hip</td>
                            <td colspan="2">hand</td>
                            <td colspan="2">wrist</td>
                            <td colspan="2">elbow</td>
                            <td colspan="2">shoulder</td>
                        </tr>   
                    </table>
                </div>
                
                

                <div class="key">
                    Key: <img id="question-button" src="../../question.png" width="15px" height="15px"/>
                    <div>
                        <div class="display-key">
                            <div>
                                color: average pain level 
                                    <span class="painOne pain-colors">1</span><span class="painTwo pain-colors">2</span><span class="painThree pain-colors">3</span><span class="painFour pain-colors">4</span><span class="painFive pain-colors">5</span>
                            </div>      
                            <div>
                                #: number of entries
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="summary">    
                    <div class="summary-section">
                        <div><b>pain level</b></div>
                        <span>average: <?php echo $_SESSION['painStats']['Avg']; ?></span>
                        <span>min: <?php echo $_SESSION['painStats']['Min']; ?></span>
                        <span>max: <?php echo $_SESSION['painStats']['Max']; ?></span>
                    </div>   
                </div>
            </div>  
            
            <div class="result <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''; ?>">
                No entries found for the day: <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date'; ?>
            </div>

        </div>
        <div class="footer">
            <div class="footer-content">
                <hr/>
                arthritis tracker | ally oliphant | 2019
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
?>