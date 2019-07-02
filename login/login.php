<?php
    session_start();
?>

<html>
	<header>
		<title>arthritis tracker</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="login.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
        <script src="../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../js/login.js"></script>
        <script src="../js/footer.js"></script>
	</header>		
	<body>
		<div class="side nav">
            <a href="../index.html"><img src="../img/logo.png" width="70px" height="70px"/></a>
		</div>
		<div class="mobile nav">	
            <a href="../index.html"><img id="mobile-logo" src="../img/logo.png" width="40px" height="40px"/></a>
		</div>	
        
		<div class="main">
            <h1>arthritis tracker</h1>

            <h2>login</h2>
			<form method="POST" action="login-handler.php">
                <div>
                    <label>Username</label>                    
                    <input id="username" type="text" name="username" placeholder="username..."
                        value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; unset($_SESSION['username']); ?>"/>
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
                <?php
                    if (isset($_SESSION['message'])) {
						$type = isset($_SESSION['good']) ? 'good' : 'error';
                        echo "<div class='message {$type}'>" . $_SESSION['message'] . "</div>";
                    }
                    unset($_SESSION['good']);
                    unset($_SESSION['message']);
                ?>
                <div>
                    <input id="login" class="button" type="submit" value="login" disabled/>
                </div>
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