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
        <link rel="stylesheet" href="account.css">
	</header>		
	<body>
		<div class="sidenav">
            <a href="../home/home.php"><img src="../logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../entry-history/year/year.php">by year</a>
            <a class="button" href="../entry-history/month/month.php">by month</a>
            <a class="button" href="../entry-history/day/day.php">by day</a>
            <a class="button current-page" id="account-nav-button" href="../account/account.php">my account</a>
            <a class="button" href="../logout/logout.php">logout</a>
		</div>	

		<div class="main">
            <h1>My Account</h1>

			<form method="POST" action="account-handler.php">
				<div>
				    <label>Name</label>
					<input type="text" name="name" 
						value="<?php echo isset($_SESSION['userinfo']['Name']) ? $_SESSION['userinfo']['Name'] : ''; ?>"/>
				</div>
				<div>
				    <label>Username</label>
				    <input type="text" name="username"
						value="<?php echo isset($_SESSION['userinfo']['Username']) ? $_SESSION['userinfo']['Username'] : ''; ?>"/>
				</div>
				<div>
				    <label>Password</label>
				    <input type="password" name="password"
						value="<?php echo isset($_SESSION['userinfo']['Password']) ? $_SESSION['userinfo']['Password'] : ''; ?>"/>
				</div>
				<div>
				    <label>Re-enter Password</label>
				    <input type="password" name="confirm-password"
						value="<?php echo isset($_SESSION['userinfo']['Password']) ? $_SESSION['userinfo']['Password'] : ''; ?>"/>
				</div>
				<div>
				    <label>Email</label>
				    <input type="text" name="email"
						value="<?php echo isset($_SESSION['userinfo']['Email']) ? $_SESSION['userinfo']['Email'] : ''; ?>"/>
				</div>
                <?php
                    if (isset($_SESSION['messages'])) {
                        foreach($_SESSION['messages'] as $message) {
						$type = isset($_SESSION['good']) ? 'good' : 'error';
                        echo "<div class='message {$type}'>{$message}</div>";
                        }
					}
                    unset($_SESSION['good']);
                    unset($_SESSION['messages']);
                ?>
				<div>
				    <input class="button" type="submit" value="save"/>
				</div>
			</form>
			
			<div class="footer">
				<hr/>
				arthritis tracker | Ally Oliphant | CS401
			</div>
		</div>
	</body>
</html>