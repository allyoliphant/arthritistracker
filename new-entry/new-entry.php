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
        <script src="../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../js/footer.js"></script>
	</header>		
	<body>
		<div class="sidenav">
            <a href="../home/home.php"><img src="../logo.png" width="70px" height="70px"/></a>
            <a class="button current-page" href="../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="../entry-history/year/year.php">year</a>
            <a class="button" href="../entry-history/month/month.php">month</a>
            <a class="button" href="../entry-history/day/day.php">day</a>
            <a class="button" id="account-nav-button" href="../account/account.php">my account</a>
            <a class="button" href="../logout/logout.php">logout</a>
		</div>	

		<div class="main">
            <h1>new entry</h1>            

            <form method="POST" action="new-entry-handler.php">
                <div>
                    <div class="label">side:</div>
                    <label><input type="radio" name="side" value="left" 
                        <?php if (isset($_SESSION['input']['side'])) {
                                echo $_SESSION['input']['side']=="left" ? "checked" : "";
                        }?>
                    >left</label>
                    <label><input type="radio" name="side" value="right"
                        <?php if (isset($_SESSION['input']['side'])) {
                                echo $_SESSION['input']['side']=="right" ? "checked" : "";
                        }?>
                    >right</label>
                </div>
                <div>
                    <div class="label">joint:</div>
                    <label><input type="radio" name="joint" value="ankle" 
                        <?php if (isset($_SESSION['input']['joint'])) {
                                echo $_SESSION['input']['joint']=="ankle" ? "checked" : "";
                        }?>
                    >ankle</label> 
                    <label><input type="radio" name="joint" value="knee" 
                        <?php if (isset($_SESSION['input']['joint'])) {
                                echo $_SESSION['input']['joint']=="knee" ? "checked" : "";
                        }?>
                    >knee</label> 
                    <label><input type="radio" name="joint" value="hip" 
                        <?php if (isset($_SESSION['input']['joint'])) {
                                echo $_SESSION['input']['joint']=="hip" ? "checked" : "";
                        }?>
                    >hip</label> 
                    <label><input type="radio" name="joint" value="hand"
                        <?php if (isset($_SESSION['input']['joint'])) {
                                echo $_SESSION['input']['joint']=="hand" ? "checked" : "";
                        }?>
                    >hand</label> 
                    <label><input type="radio" name="joint" value="wrist"
                        <?php if (isset($_SESSION['input']['joint'])) {
                                echo $_SESSION['input']['joint']=="wrist" ? "checked" : "";
                        }?>
                    >wrist</label> 
                    <label><input type="radio" name="joint" value="elbow"
                        <?php if (isset($_SESSION['input']['joint'])) {
                                echo $_SESSION['input']['joint']=="elbow" ? "checked" : "";
                        }?>
                    >elbow</label>
                    <label><input type="radio" name="joint" value="shoulder"
                        <?php if (isset($_SESSION['input']['joint'])) {
                                echo $_SESSION['input']['joint']=="shoulder" ? "checked" : "";
                        }?>
                    >shoulder</label> 
                </div>
                <div>
                    <div class="label">pain level:</div>
                    <label><input type="radio" name="pain" value="1" 
                        <?php if (isset($_SESSION['input']['pain'])) {
                                echo $_SESSION['input']['pain']==1 ? "checked" : "";
                        }?>
                    >1</label>
                    <label><input type="radio" name="pain" value="2" 
                        <?php if (isset($_SESSION['input']['pain'])) {
                                echo $_SESSION['input']['pain']==2 ? "checked" : "";
                        }?>
                    >2</label>
                    <label><input type="radio" name="pain" value="3" 
                        <?php if (isset($_SESSION['input']['pain'])) {
                                echo $_SESSION['input']['pain']==3 ? "checked" : "";
                        }?>
                    >3</label> 
                    <label><input type="radio" name="pain" value="4" 
                        <?php if (isset($_SESSION['input']['pain'])) {
                                echo $_SESSION['input']['pain']==4 ? "checked" : "";
                        }?>
                    >4</label> 
                    <label><input type="radio" name="pain" value="5" 
                        <?php if (isset($_SESSION['input']['pain'])) {
                                echo $_SESSION['input']['pain']==5 ? "checked" : "";
                        }?>
                    >5</label>  
                </div>
                <div>
                    <div class="label">date:</div>
                    <input type="date" name="date" min="1990-01-01"
                    <?php
                        date_default_timezone_set('America/Boise');
                        $date = date("Y-m-d");
                        echo "max='{$date}'";
                        $value = isset($_SESSION['input']['date']) ? $_SESSION['input']['date'] : $date;
                        echo "value='{$value}'";                        
                    ?>/>  
                </div>
                <div>
                    <div class="label">time:</div>
                    <input type="time" name="time" 
                    <?php
                        date_default_timezone_set('America/Boise');
                        $time = date("H:i");
                        $value = isset($_SESSION['input']['time']) ? $_SESSION['input']['time'] : $time;
                        echo "value='{$value}'";                        
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
                    unset($_SESSION['input']);
                ?>
                <div>
                    <input class="button" type="submit" value="add"/>  
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