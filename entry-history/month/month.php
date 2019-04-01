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
                    </tr>
                    <tr>
                        <td class="y-axis">12pm</td>
                    </tr>
                    <tr>
                        <td class="y-axis">6am</td>
                    </tr>
                    <tr>
                        <td class="y-axis">12am</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="x-axis">1</td>
                        <td class="x-axis">2</td>
                        <td class="x-axis">3</td>
                        <td class="x-axis">4</td>
                        <td class="x-axis">5</td>
                        <td class="x-axis">6</td>
                        <td class="x-axis">7</td>
                        <td class="x-axis">8</td>
                        <td class="x-axis">9</td>
                        <td class="x-axis">10</td>
                        <td class="x-axis">11</td>
                        <td class="x-axis">12</td>
                        <td class="x-axis">13</td>
                        <td class="x-axis">14</td>
                        <td class="x-axis">15</td>
                        <td class="x-axis">16</td>
                        <td class="x-axis">17</td>
                        <td class="x-axis">18</td>
                        <td class="x-axis">19</td>
                        <td class="x-axis">20</td>
                        <td class="x-axis">21</td>
                        <td class="x-axis">22</td>
                        <td class="x-axis">23</td>
                        <td class="x-axis">24</td>
                        <td class="x-axis">25</td>
                        <td class="x-axis">26</td>
                        <td class="x-axis">27</td>
                        <td class="x-axis">28</td>
                        <?php $e->xAxis($_SESSION['date']); ?>
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