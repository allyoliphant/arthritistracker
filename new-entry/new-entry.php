<?php
	session_start();

	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$_SESSION['message'] = "Please login to view";
		header("Location: ../login/login.php");
		exit();
	}
?>

<html>
	<header>
		<title>arthritis tracker</title>
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
        <link rel="stylesheet" href="new-entry.css">
	</header>		
	<body>
		<div class="sidenav">
            <a href="../home/home.php"><img src="../logo.png" width="70px" height="70px"/></a>
            <a class="button current-page" href="../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../entry-history/year/year.php">by year</a>
            <a class="button" href="../entry-history/month/month.php">by month</a>
            <a class="button" href="../entry-history/day/day.php">by day</a>
            <a class="button" id="account-nav-button" href="../account/account.php">my account</a>
            <a class="button" href="../logout/logout.php">logout</a>
		</div>	

		<div class="main">
            <h1>new entry</h1>
            

            <form method="POST">
                <div>
                    <div class="label">side:</div>
                    <input type="radio" name="side" value="left"/>left
                    <input type="radio" name="side" value="right"/>right 
                </div>
                <div>
                    <div class="label">joint:</div>
                    <input type="radio" name="joint" value="ankle"/>ankle 
                    <input type="radio" name="joint" value="knee"/>knee 
                    <input type="radio" name="joint" value="hip"/>hip 
                    <input type="radio" name="joint" value="hand"/>hand 
                    <input type="radio" name="joint" value="wrist"/>wrist 
                    <input type="radio" name="joint" value="elbow"/>elbow
                    <input type="radio" name="joint" value="shoulder"/>shoulder  
                </div>
                <div>
                    <div class="label">pain level:</div>
                    <input type="radio" name="pain" value="1"/>1 
                    <input type="radio" name="pain" value="2"/>2 
                    <input type="radio" name="pain" value="3"/>3 
                    <input type="radio" name="pain" value="4"/>4 
                    <input type="radio" name="pain" value="5"/>5  
                    <input type="radio" name="pain" value="0"/>unknown  
                </div>
                <div>
                    <div class="label">date:</div>
                    <input type="date" name="date" min="1900-01-01"/>  
                </div>
                <div>
                    <div class="label">time range:</div>
                    <input type="radio" name="time" value="1"/>12am-6am 
                    <input type="radio" name="time" value="2"/>6am-12pm 
                    <input type="radio" name="time" value="3"/>12pm-6pm 
                    <input type="radio" name="time" value="4"/>6pm-12am  
                </div>
                <div>
                    <input class="button" type="submit" value="add"/>  
                </div>
            </form>
            

			<div class="footer">
				<hr/>
				arthritis tracker | ally oliphant | cs401 | Spring 2019
			</div>
		</div>
	</body>
</html>