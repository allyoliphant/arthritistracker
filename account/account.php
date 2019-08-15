<?php
	session_start();

	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$_SESSION['message'] = "Please login to view";
		header("Location: /login/login.php");
		exit();
	}

    include_once '../Page.php';
    $page = new Page();
?>

<html>
	<header>		
		<?php $page->header(true); ?>
        <script src="/js/min/account.min.js"></script>
	</header>		
	<body>		
		<?php $page->navigation('account'); ?>	

		<div class="main">
            <h1 class="align-left">My Account</h1>

			<form method="POST" action="account-handler.php" class="align-left">
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
			
			<?php $page->footer(); ?>	
		</div>
	</body>
</html>