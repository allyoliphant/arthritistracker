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
        <link rel="stylesheet" href="year.css">
        <script src="../../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../../js/footer.js"></script>
        <script src="../../js/entry-history.js"></script>
        <script src="../../js/mobile.js"></script>
	</header>		
	<body>
		<div class="side nav">
            <a href="../../home/home.php"><img src="../../logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button current-page" href="../year/year.php">year</a>
            <a class="button" href="../month/month.php">month</a>
            <a class="button" href="../day/day.php">day</a>
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
			<a class="mobile-btn current-page" href="../../entry-history/year/year.php">year</a>
			<a class="mobile-btn" href="../../entry-history/month/month.php">month</a>
			<a class="mobile-btn" href="../../entry-history/day/day.php">day</a>
			<a class="mobile-btn" id="account-nav-button" href="../../account/account.php">account</a>
			<a class="mobile-btn" href="../../logout/logout.php">logout</a>
		</div>

		<div class="main">
            <h1>entry history by year</h1>

            <form method="GET" action="year-handler.php">
                <label>year:</label>
                <input type="number" min="1990" name="date"
                <?php
                    date_default_timezone_set('America/Boise');
                    $date = date("Y");
                    echo "max='{$date}'";
                    $year = isset($_SESSION['date']) ? $_SESSION['date'] : $date;
                    echo "value='{$year}'";                        
                ?>/>
                <input class="button" type="submit" value="view entries"/>
            </form>

            <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='error message'>" . $_SESSION['message'] . "</div>";
                }
                unset($_SESSION['message']);
            ?>

            <div class="result <?php echo isset($_SESSION['show']) ? $_SESSION['show'] : ''; 
                unset($_SESSION['show']);?>">
                <div class="date"><b>History for the year: <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date'; ?></b></div>
                <div class="entry-table">
                    <table>
                        <tr>
                            <td id="top-y-value">12am</td>
                        </tr>
                        <tr>
                            <td class="y-axis">6pm</td>
                            <?php $e->getClassAndCount_Year('time4', $_SESSION['date']); ?>
                        </tr>
                        <tr>
                            <td class="y-axis">12pm</td>
                            <?php $e->getClassAndCount_Year('time3', $_SESSION['date']); ?>
                        </tr>
                        <tr>
                            <td class="y-axis">6am</td>
                            <?php $e->getClassAndCount_Year('time2', $_SESSION['date']); ?>
                        </tr>
                        <tr>
                            <td class="y-axis">12am</td>
                            <?php $e->getClassAndCount_Year('time1', $_SESSION['date']); ?>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="x-axis">Jan</td>
                            <td class="x-axis">Feb</td>
                            <td class="x-axis">Mar</td>
                            <td class="x-axis">Apr</td>
                            <td class="x-axis">May</td>
                            <td class="x-axis">Jun</td>
                            <td class="x-axis">Jul</td>
                            <td class="x-axis">Aug</td>
                            <td class="x-axis">Sept</td>
                            <td class="x-axis">Oct</td>
                            <td class="x-axis">Nov</td>
                            <td class="x-axis">Dec</td>
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
                                number: number of entries
                            </div>
                        </div>
                    </div>
                </div> 
    
                <div class="summary">    
                    <div class="summary-section">
                        <div><b>pain level</b></div>
                        <span>average: <?php echo $_SESSION['painStats']['Avg']; ?></span>
                        <span>min: <?php echo $_SESSION['painStats']['Min']; ?></span>
                        <span>max: <?php echo $_SESSION['painStats']['Max']; 
                            unset($_SESSION['painStats']);?></span>
                    </div>   
                    <div class="summary-section">
                        <div><b>left</b></div>
                        <span>ankle: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Ankle'] : 0; ?></span>
                        <span>knee: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Knee'] : 0; ?></span>
                        <span>hip: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Hip'] : 0; ?></span>
                        <span>hand: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Hand'] : 0; ?></span>
                        <span>wrist: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Wrist'] : 0; ?></span>
                        <span>elbow: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Elbow'] : 0; ?></span>
                        <span>shoulder: <?php echo isset($_SESSION['left']) ? $_SESSION['left']['Shoulder'] : 0; 
                            unset($_SESSION['left']);?></span>
                    </div>
                    <div class="summary-section">
                        <div><b>right</b></div>
                        <span>ankle: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Ankle'] : 0; ?></span>
                        <span>knee: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Knee'] : 0; ?></span>
                        <span>hip: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Hip'] : 0; ?></span>
                        <span>hand: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Hand'] : 0; ?></span>
                        <span>wrist: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Wrist'] : 0; ?></span>
                        <span>elbow: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Elbow'] : 0; ?></span>
                        <span>shoulder: <?php echo isset($_SESSION['right']) ? $_SESSION['right']['Shoulder'] : 0; 
                            unset($_SESSION['right']);?></span>
                    </div>
                </div>
            </div>    
            
            <div class="result <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : '';
                unset($_SESSION['error']); ?>">
                No entries found for the year: <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date'; 
                unset($_SESSION['date']); ?>
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
?>