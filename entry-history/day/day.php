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
        <link rel="stylesheet" href="day.css">
	</header>		
	<body>
		<div class="sidenav">
            <a href="../../home/home.php"><img src="../../logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../year/year.php">by year</a>
            <a class="button" href="../month/month.php">by month</a>
            <a class="button current-page" href="../day/day.php">by day</a>
            <a class="button" id="account-nav-button" href="../../account/account.php">my account</a>
            <a class="button" href="../logout/logout.php">logout</a>
		</div>	

		<div class="main">
            <h1>entry history</h1>

            <form>
                <label>month:</label>
                <input type="number" min="1" max="12" step="1" name="month"/>
                <label>year:</label>
                <input type="number" min="1900" max="2019" step="1" name="year"/>
                <label>day:</label>
                <input type="number" min="1" max="31" step="1" name="day"/>
                <input class="button" type="submit" value="view entries"/>
            </form>

            <div class="result">
                <div>Day: ##-##-####</div>
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
                        <td>total</td>
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
    
                <div class="summary">    
                    <div class="summary-section">
                        <div>pain level</div>
                        <span>average: #</span>
                        <span>min: #</span>
                        <span>max: #</span>
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