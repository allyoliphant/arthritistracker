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
        <link rel="stylesheet" href="account.css">
        <script src="/js/min/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="/js/min/account.min.js"></script>
        <script src="/js/min/footer.min.js"></script>
        <script src="/js/min/mobile.min.js"></script>
        <script src="/js/min/logout.min.js"></script>
		<!-- jQuery Modal -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
	</header>		
	<body>
		<div class="side nav">
            <a href="../home/home.php"><img src="../img/logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../entry-history/year/year.php">year</a>
            <a class="button" href="../entry-history/month/month.php">month</a>
            <a class="button" href="../entry-history/day/day.php">day</a>
            <a class="button current-page" id="account-nav-button" href="../account/account.php">my account</a>
            <a class="button" href="/logout/logout.php" rel="ajax:modal">logout</a>
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
			<a class="mobile-btn current-page" id="account-nav-button" href="../account/account.php">account</a>
            <a class="mobile-btn" href="/logout/logout.php" rel="ajax:modal">logout</a>
		</div>	

		<div class="main">
            <h1>My Account</h1>

			<form method="POST" action="account-handler.php">
				<div>
				    <label>Name</label>
					<input id="name" type="text" name="name" placeholder="name..."
						value="<?php echo isset($_SESSION['user-name']) ? $_SESSION['user-name'] : ''; ?>"/>
                    <span id="name-js-message" class="error message">* name must be 1 to 30 letters/numbers long</span>
				</div>
				<div>
				    <label>Username</label>
				    <input id="username" type="text" name="username" placeholder="username..."
						value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"/>
                    <span id="username-js-message" class="error message">* username must be 4 to 30 letters/numbers long</span>
				</div>
				<div>
				    <label>Password</label>
				    <input id="password" type="password" name="password" placeholder="password..."/>
                    <span id="password-js-message-length" class="error message">* password must be 6+ characters long</span>
                    <span id="password-js-message-number" class="error message">* password must have 1+ numbers</span>
                    <span id="password-js-message-letter" class="error message">* password must have 1+ letters</span>
                    <span id="password-js-message-special" class="error message">* password must have 1+ special characters: ! @ # $ % & ? - _</span>
				</div>
				<div>
				    <label>Re-enter Password</label>
				    <input id="confirm-password" type="password" name="confirm-password" placeholder="re-enter password..."/>
                    <span id="confirm-password-js-message" class="error message">* passwords do not match</span>
				</div>
				<div>
				    <label>Email</label>
				    <input id="email" type="text" name="email" placeholder="email..."
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
				<div class="footer-content">
					<hr/>
					arthritis tracker | ally oliphant | 2019
				</div>				
			</div>
		</div>
	</body>
</html>