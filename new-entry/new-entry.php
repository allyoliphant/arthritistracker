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
		<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
        <link rel="stylesheet" href="new-entry.css">
	</header>		
	<body>
		<div class="sidenav">
            <a href="../home/home.php"><img src="../logo.png" width="70px" height="70px"/></a>
            <a class="button current-page" href="../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../entry-history/year/year.php">by year</a>
            <a class="button" href="../entry-history/month/month.php">by month</a>
            <a class="button" href="../entry-history/day/day.php">by day</a>
            <a class="button" id="account-nav-button" href="../account/account.php">my account</a>
            <a class="button" href="../logout/logout.php">logout</a>
		</div>	

		<div class="main">
            <h1>new entry</h1>            

            <form method="POST" action="new-entry-handler.php">
                <div>
                    <div class="label">side:</div>
                    <label><input type="radio" name="side" value="left">left</label>
                    <label><input type="radio" name="side" value="right">right</label>
                </div>
                <div>
                    <div class="label">joint:</div>
                    <label><input type="radio" name="joint" value="ankle">ankle</label> 
                    <label><input type="radio" name="joint" value="knee">knee</label> 
                    <label><input type="radio" name="joint" value="hip">hip</label> 
                    <label><input type="radio" name="joint" value="hand">hand</label> 
                    <label><input type="radio" name="joint" value="wrist">wrist</label> 
                    <label><input type="radio" name="joint" value="elbow">elbow</label>
                    <label><input type="radio" name="joint" value="shoulder">shoulder</label> 
                </div>
                <div>
                    <div class="label">pain level:</div>
                    <label><input type="radio" name="pain" value="1">1</label>
                    <label><input type="radio" name="pain" value="2">2</label>
                    <label><input type="radio" name="pain" value="3">3</label> 
                    <label><input type="radio" name="pain" value="4">4</label> 
                    <label><input type="radio" name="pain" value="5">5</label>  
                </div>
                <div>
                    <div class="label">date:</div>
                    <input type="date" name="date" min="1990-01-01"
                    <?php
                        date_default_timezone_set('America/Boise');
                        $date = date("Y-m-d");
                        echo "max='{$date}'";
                        echo "value='{$date}'";                        
                    ?>/>  
                </div>
                <div>
                    <div class="label">time:</div>
                    <input type="time" name="time" 
                    <?php
                        date_default_timezone_set('America/Boise');
                        $time = date("H:i");
                        echo "value='{$time}'";                        
                    ?>/>  
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
                <?php
                    if (isset($_SESSION['input'])) {
                        echo "<div>" . print_r($_SESSION['input'], 1)  . "</div>";
					}
                    unset($_SESSION['input']);
                ?>
                <div>
                    <input class="button" type="submit" value="add"/>  
                </div>
            </form>

            <div class="footer">
				<hr/>
				arthritis tracker | ally oliphant | cs401 | Spring 2019
			</div>
		</div>
	</body>
</html>