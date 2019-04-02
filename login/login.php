<?php
    session_start();
?>

<html>
	<header>
		<title>arthritis tracker</title>
		<link rel="stylesheet" href="login.css">
	</header>		
	<body>
		<div class="sidenav">
                <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico">
            <a href="../index.html"><img src="../logo.png" width="70px" height="70px"/></a>
        </div>	
        
		<div class="main">
            <h1>arthritis tracker</h1>

            <h2>login</h2>
			<form method="POST" action="login-handler.php">
                <div>
                    <label>Username</label>                    
                    <input type="text" name="username"
                        value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; unset($_SESSION['username']); ?>"/>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password"/>
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
                    <input class="button" type="submit" value="login"/>
                </div>
            </form>

            <div class="footer">
				<hr/>
                arthritis tracker | Ally Oliphant | CS401 | Spring 2019
            </div>
		</div>
	</body>
</html>