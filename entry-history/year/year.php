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
        <link rel="stylesheet" href="year.css">
	</header>		
	<body>
		<div class="sidenav">
            <a href="../../home/home.php"><img src="../../logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button current-page" href="../year/year.php">by year</a>
            <a class="button" href="../month/month.php">by month</a>
            <a class="button" href="../day/day.php">by day</a>
            <a class="button" id="account-nav-button" href="../../account/account.php">my account</a>
            <a class="button" href="../../logout/logout.php">logout</a>
		</div>	

		<div class="main">
            <h1>entry history</h1>

            <form>
                <label>year:</label>
                <input type="number" min="1900" max="2019" name="year"/>
                <input class="button" type="submit" value="view entries"/>
            </form>

            <div class="result">
                <div>Year: ####</div>
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
                        <td></td>
                    </tr>
                    <tr>
                        <td class="y-axis">12am</td>
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
                        <td class="x-axis">Sep</td>
                        <td class="x-axis">Oct</td>
                        <td class="x-axis">Nov</td>
                        <td class="x-axis">Dec</td>
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