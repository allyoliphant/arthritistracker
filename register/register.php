<?php
    session_start();
?>

<html>
    <header>
        <title>arthritis tracker</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="register.css">
        <script src="/js/min/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="/js/min/account.min.js"></script>
        <script src="/js/min/footer.min.js"></script>
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

            <h2>register</h2>
			<form method="POST" action="register-handler.php">
                <div>
                    <label>Name</label>                   
                    <input id="name" type="text" name="name" placeholder="name..."
                        value="<?php echo isset($_SESSION['input']['name']) ? $_SESSION['input']['name'] : ''; 
                            unset($_SESSION['input']['name']); ?>"/>
                    <span id="name-js-message" class="error message">* name must be 1 to 30 letters/numbers long</span>
                </div>
                <div>
                    <label>Username</label>                   
                    <input id="username" type="text" name="username" placeholder="username..."
                        value="<?php echo isset($_SESSION['input']['username']) ? $_SESSION['input']['username'] : ''; 
                            unset($_SESSION['input']['username']); ?>"/>
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
                        value="<?php echo isset($_SESSION['input']['email']) ? $_SESSION['input']['email'] : ''; 
                            unset($_SESSION['input']['email']); ?>"/>
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
                    <input id="save" class="button" type="submit" value="register" disabled/>
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