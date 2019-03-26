<?php
    session_start();
?>

<html>
    <html>
        <header>
            <title>arthritis tracker</title>
            <link rel="stylesheet" href="register.css">
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
                    <input type="text" name="name"
                        value="<?php echo isset($_SESSION['input']['name']) ? $_SESSION['input']['name'] : ''; 
                            unset($_SESSION['input']['name']); ?>"/>
                </div>
                <div>
                    <label>Username</label>                   
                    <input type="text" name="username"
                        value="<?php echo isset($_SESSION['input']['username']) ? $_SESSION['input']['username'] : ''; 
                            unset($_SESSION['input']['username']); ?>"/>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password"/>
                </div>
                <div>
                    <label>Confirm Password</label>
                    <input type="password" name="confirm-password"/>
                </div>
                <div>
                    <label>Email</label>                  
                    <input type="text" name="email"
                        value="<?php echo isset($_SESSION['input']['email']) ? $_SESSION['input']['email'] : ''; 
                            unset($_SESSION['input']['email']); ?>"/>
                </div>
                <?php
                    if (isset($_SESSION['messages'])) {
                        foreach($_SESSION['messages'] as $message) {
                        echo "<div class='error-message'>{$message}</div>";
                        }
                    }
                    unset($_SESSION['messages']);
                ?>
                <div>
                    <input class="button" type="submit" value="register"/>
                </div>
            </form>

            <div class="footer">
				<hr/>
                arthritis tracker | Ally Oliphant | CS401 | Spring 2019
            </div>
		</div>
	</body>
</html>