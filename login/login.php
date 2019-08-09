<?php
    session_start();
    
    include_once '../Page.php';
    $page = new Page();
?>

<html>
	<header>
		<?php $page->header(false); ?>
        <script src='/js/min/login.min.js'></script>
	</header>		
	<body>
		<div class="side nav">
            <a href="/index.html"><img src="/img/logo.png" width="70px" height="70px"/></a>
		</div>
		<div class="mobile nav">	
            <a href="/index.html"><img id="mobile-logo" src="/img/logo.png" width="40px" height="40px"/></a>
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
		<?php $page->footer(); ?>
	</body>
</html>