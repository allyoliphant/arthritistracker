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
        <link rel="stylesheet" href="logout.css">
	</header>		
	<body>
		<div class="sidenav">
            <a href="../home/home.php"><img src="../logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../entry-history/year/year.php">by year</a>
            <a class="button" href="../entry-history/month/month.php">by month</a>
            <a class="button" href="../entry-history/day/day.php">by day</a>
            <a class="button" id="account-nav-button" href="../account/account.php">my account</a>
            <a class="button current-page" href="../logout/logout.php">logout</a>
		</div>	

		<div class="main">
            <h1>logout</h1>
            
            <form method="GET" action="logout-handler.php">
                <p>Are you sure you want to log out?</p>
                <input class="button" type="submit" value="yes" name="answer"/>
            </form>
			
			<div class="footer">
				<hr/>
				arthritis tracker | Ally Oliphant | CS401
			</div>
		</div>
	</body>
</html>