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
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo "<input type='text' name='name' value='" . $_SESSION['name'] . "'/>";
                        }
                        else {
                            echo "<input type='text' name='name'/>";
                        }
                        unset($_SESSION['error']);
                        unset($_SESSION['name']);
                    ?>
                </div>
                <div>
                    <label>Username</label>
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo "<input type='text' name='username' value='" . $_SESSION['username'] . "'/>";
                        }
                        else {
                            echo "<input type='text' name='username'/>";
                        }
                        unset($_SESSION['error']);
                        unset($_SESSION['username']);
                    ?>
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
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo "<input type='text' name='email' value='" . $_SESSION['email'] . "'/>";
                        }
                        else {
                            echo "<input type='text' name='email'/>";
                        }
                        unset($_SESSION['error']);
                        unset($_SESSION['email']);
                    ?>
                </div>
                <?php
                    if (isset($_SESSION['error'])) {
                        echo "<div id='error'>" . $_SESSION['message'] . "</div>";
                    }
                    unset($_SESSION['error']);
                    unset($_SESSION['message']);
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