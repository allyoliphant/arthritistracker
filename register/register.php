<?php
    session_start();
?>

<html>
    <html>
        <header>
            <title>arthritis tracker</title>
            <link rel="stylesheet" href="register.css">
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
            <script src="../js/register.js"></script>
        </header>		
        <body>
            <div class="sidenav">
                    <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico">
                <a href="../index.html"><img src="../logo.png" width="70px" height="70px"/></a>
            </div>	
        
		<div class="main">
            <h1>arthritis tracker</h1>

            <h2>register</h2>
			<form method="POST" action="register-handler.php">
                <div>
                    <label>Name</label>                   
                    <input id="name" type="text" name="name"
                        value="<?php echo isset($_SESSION['input']['name']) ? $_SESSION['input']['name'] : ''; 
                            unset($_SESSION['input']['name']); ?>"/>
                    <span id="name-js-message" class="error message">* name must be 1 to 30 letters long</span>
                </div>
                <div>
                    <label>Username</label>                   
                    <input id="username" type="text" name="username"
                        value="<?php echo isset($_SESSION['input']['username']) ? $_SESSION['input']['username'] : ''; 
                            unset($_SESSION['input']['username']); ?>"/>
                    <span id="username-js-message" class="error message">* username must be 6 to 30 letters/numbers long</span>
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
                    <input id="register" class="button" type="submit" value="register"/>
                </div>
            </form>

            <div class="footer">
				<hr/>
                arthritis tracker | Ally Oliphant | CS401 | Spring 2019
            </div>
		</div>
	</body>
</html>