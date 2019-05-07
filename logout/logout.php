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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
        <link rel="stylesheet" href="logout.css">
        <script src="../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../js/footer.js"></script>
        <script src="../js/mobile.js"></script>
	</header>		
	<body>
		<div class="side nav">
            <a href="../home/home.php"><img src="../img/logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../entry-history/year/year.php">year</a>
            <a class="button" href="../entry-history/month/month.php">month</a>
            <a class="button" href="../entry-history/day/day.php">day</a>
            <a class="button" id="account-nav-button" href="../account/account.php">my account</a>
            <a class="button current-page" href="../logout/logout.php">logout</a>
		</div>
		<div class="mobile nav">	
            <a href="../home/home.php"><img id="mobile-logo" src="../img/logo.png" width="40px" height="40px"/></a>	
			<div id="menuToggle">	
				<input type="checkbox" />			
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>	
		<div class="mobile-menu">
			<a class="mobile-btn" href="../new-entry/new-entry.php">New Entry</a>
			<p id="history-section-title">entry history</p>
			<a class="mobile-btn" href="../entry-history/year/year.php">year</a>
			<a class="mobile-btn" href="../entry-history/month/month.php">month</a>
			<a class="mobile-btn" href="../entry-history/day/day.php">day</a>
			<a class="mobile-btn" id="account-nav-button" href="../account/account.php">account</a>
			<a class="mobile-btn current-page" href="../logout/logout.php">logout</a>
		</div>		

		<div class="main">
            <h1>logout</h1>
            
            <form method="GET" action="logout-handler.php">
                <p>Are you sure you want to log out?</p>
                <input class="button" type="submit" value="yes" name="answer"/>
            </form>
			
		</div>
        <div class="footer">
            <div class="footer-content">
                <hr/>
                arthritis tracker | ally oliphant | 2019
            </div>				
		</div>
	</body>
</html>