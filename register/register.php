<?php
    session_start();
    
    include_once '../Page.php';
    $page = new Page();
?>

<html>
    <header>
		<?php $page->header(false); ?>
        <script src="/js/min/account.min.js"></script>
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
		<?php $page->footer(); ?>
	</body>
</html>