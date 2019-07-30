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
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="home.css">
        <script src="../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../js/footer.js"></script>
        <script src="../js/mobile.js"></script>
        <script src="../js/logout.js"></script>
		<!-- jQuery Modal -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
	</header>		
	<body>
		<div class="side nav">
            <img src="../img/logo.png" width="70px" height="70px"/>
            <a class="button" href="../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../entry-history/year/year.php">year</a>
            <a class="button" href="../entry-history/month/month.php">month</a>
            <a class="button" href="../entry-history/day/day.php">day</a>
            <a class="button" id="account-nav-button" href="../account/account.php">account</a>
            <a class="button" href="/logout/logout.php" rel="ajax:modal">logout</a>
		</div>
		<div class="mobile nav">	
			<img id="mobile-logo" src="../img/logo.png" width="40px" height="40px"/>			
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
            <a class="mobile-btn" href="/logout/logout.php" rel="ajax:modal">logout</a>
		</div>

		<div class="main">
			<h1>welcome</h1>
			<?php echo "<h2 class='name'>" . $_SESSION['user-name'] . "</h2>"; ?>
            
            <a class="button" href="../new-entry/new-entry.php">new entry</a>
		</div>

		<div class="footer">
			<div class="footer-content">
				<hr/>
				arthritis tracker | ally oliphant | 2019
			</div>				
		</div>
	</body>
</html>