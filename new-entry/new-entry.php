<?php
	session_start();

	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$_SESSION['message'] = "Please login to view";
		header("Location: /login/login.php");
		exit();
    }

    include_once '../Page.php';
    $page = new Page();

    date_default_timezone_set(timezone_name_get(new DateTimeZone('America/Boise')));
?>  

<html>
	<header>
		<?php $page->header(true); ?>
        <link rel="stylesheet" href="/new-entry/new-entry.css">
        <script src="/js/min/jquery.validate.min.js"></script>
        <script src="/js/min/new-entry.min.js"></script>
	</header>		
	<body>
		<?php $page->navigation('new entry'); ?>

		<div class="main">
            <h1 class="align-left">new entry</h1>            

            <form id="entry-form" method="POST" action="new-entry-handler.php" class="align-left">
                <div>
                    <div class="label">side:</div>
                    <label><input type="radio" name="side" value="left" required
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
                    <label><input type="radio" name="joint" value="ankle" required
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
                    <label><input type="radio" name="pain" value="1" required
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
                    <input id="new-entry-date" type="date" name="date" min="1990-01-01" required
                    <?php
                        $date = date("Y-m-d");
                        echo "max='{$date}'";
                        $value = isset($_SESSION['input']['date']) ? $_SESSION['input']['date'] : $date;
                        echo "value='{$value}'";                        
                    ?>/>  
                </div>
                <div>
                    <div class="label">time:</div>
                    <input id="new-entry-time" type="time" name="time" required
                    <?php
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
                    <input id="add-entry" class="button" type="submit" value="add" disabled/>  
                </div>
            </form>
		</div>
			
        <?php $page->footer(); ?>
	</body>
</html>