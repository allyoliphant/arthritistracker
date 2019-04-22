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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
        <script src="../js/account.js"></script>
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
					<input id="name" type="text" name="name" 
						value="<?php echo isset($_SESSION['user-name']) ? $_SESSION['user-name'] : ''; ?>"/>
                    <span id="name-js-message" class="error message">* name must be 1 to 30 letters/numbers long</span>
				</div>
				<div>
				    <label>Username</label>
				    <input id="username" type="text" name="username"
						value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"/>
                    <span id="username-js-message" class="error message">* username must be 4 to 30 letters/numbers long</span>
				</div>
				<div>
				    <label>Password</label>
				    <input id="password" type="password" name="password"/>
                    <span id="password-js-message-length" class="error message">* password must be 6+ characters long</span>
                    <span id="password-js-message-number" class="error message">* password must have 1+ numbers</span>
                    <span id="password-js-message-letter" class="error message">* password must have 1+ letters</span>
                    <span id="password-js-message-special" class="error message">* password must have 1+ special characters: ! @ # $ % & ? - _</span>
				</div>
				<div>
				    <label>Re-enter Password</label>
				    <input id="confirm-password" type="password" name="confirm-password"/>
                    <span id="confirm-password-js-message" class="error message">* passwords do not match</span>
				</div>
				<div>
				    <label>Email</label>
				    <input id="email" type="text" name="email"
						value="<?php echo isset($_SESSION['user-email']) ? $_SESSION['user-email'] : ''; ?>"/>
                    <span id="email-js-message" class="error message">* invalid email</span>
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
				    <input id="save" class="button" type="submit" value="save" disabled/>
				</div>
			</form>
			
			<div class="footer">
				<hr/>
				arthritis tracker | Ally Oliphant | CS401
			</div>
		</div>
	</body>
</html>