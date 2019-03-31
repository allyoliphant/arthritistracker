<?php
	session_start();

	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$_SESSION['message'] = "Please login to view";
		header("Location: ../../login/login.php");
		exit();
	}
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

            <form>
                <label>month:</label>
                <input type="month" name="month" min="1990-01"
                <?php
                    date_default_timezone_set('America/Boise');
                    $date = date("Y-m");
                    echo "max='{$date}'";
                    echo "value='{$date}'";                        
                ?>/>
                <input class="button" type="submit" value="view entries"/>
            </form>

            <div class="result">
                <div>Month: ##-####</div>
                <table>
                    <tr>
                        <td>total</td>
                    </tr> 
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
                        <td class="x-axis">29</td>
                        <td class="x-axis">30</td>
                        <td class="x-axis">31</td>
                        <td>total</td>
                    </tr>   
                </table>
    
                <div class="summary">    
                    <div class="summary-section">
                        <div>pain level</div>
                        <span>average: #</span>
                        <span>min: #</span>
                        <span>max: #</span>
                    </div>   
                    <div class="summary-section">
                        <div>left</div>
                        <span>ankle: #</span>
                        <span>knee: #</span>
                        <span>hip: #</span>
                        <span>hand: #</span>
                        <span>wrist: #</span>
                        <span>elbow: #</span>
                        <span>shoulder: #</span>
                    </div>
                    <div class="summary-section">
                        <div>right</div>
                        <span>ankle: #</span>
                        <span>knee: #</span>
                        <span>hip: #</span>
                        <span>hand: #</span>
                        <span>wrist: #</span>
                        <span>elbow: #</span>
                        <span>shoulder: #</span>
                    </div>
                </div>
            </div>        
			
			<div class="footer">
				<hr/>
				arthritis tracker | Ally Oliphant | CS401
			</div>
		</div>
	</body>
</html>