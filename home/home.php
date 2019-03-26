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
        <link rel="stylesheet" href="home.css">
	</header>		
	<body>
		<div class="sidenav">
            <img src="../logo.png" width="70px" height="70px"/>
            <a class="button" href="../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../entry-history/year/year.php">by year</a>
            <a class="button" href="../entry-history/month/month.php">by month</a>
            <a class="button" href="../entry-history/day/day.php">by day</a>
            <a class="button" id="account-nav-button" href="../account/account.php">account</a>
            <a class="button" href="../logout/logout.php">logout</a>
		</div>	

		<div class="main">
			<h1>welcome</h1>
			<?php echo "<h2 class='name'>" . $_SESSION['userinfo']['Name'] . "</h2>"; ?>
            
            <a class="button" href="../new-entry/new-entry.php">new entry</a>

			<div class="footer">
				<hr/>
				arthritis tracker | ally oliphant | cs401 | Spring 2019
			</div>
		</div>
	</body>
</html>