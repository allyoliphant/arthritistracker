<?php
	session_start();

	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$_SESSION['message'] = "Please login to view";
		header("Location: /login/login.php");
		exit();
    } 

    require_once '../Entry.php';
    $e = new Entry();
?>

<html>
	<header>
		<title>arthritis tracker</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="/index.min.css">
        <link rel="stylesheet" href="/entry-history/entry-history.min.css">
        <link rel="stylesheet" href="/entry-history/day/day.css">
        <script src="/js/min/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="/js/min/jquery.validate.min.js"></script>
        <script src="/js/min/footer.min.js"></script>
        <script src="/js/min/entry-history.min.js"></script>
        <script src="/js/min/mobile.min.js"></script>
        <script src="/js/min/logout.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jQuery Modal -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> 
	</header>		
	<body>
		<div class="side nav">
            <a href="/home/home.php"><img src="/img/logo.png" width="70px" height="70px"/></a>
            <a class="button" href="/new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button" href="/year/year.php">year</a>
            <a class="button" href="/month/month.php">month</a>
            <a class="button current-page" href="/day/day.php">day</a>
            <a class="button" id="account-nav-button" href="/account/account.php">my account</a>
            <a class="button" href="/logout/logout.php" rel="ajax:modal">logout</a>
		</div>	
		<div class="mobile nav">	
            <a href="/home/home.php"><img id="mobile-logo" src="/img/logo.png" width="40px" height="40px"/></a>	
			<div id="menuToggle">	
				<input type="checkbox" />			
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>	
		<div class="mobile-menu">
			<a class="mobile-btn" href="/new-entry/new-entry.php">New Entry</a>
			<p id="history-section-title">entry history</p>
			<a class="mobile-btn" href="/entry-history/year/year.php">year</a>
			<a class="mobile-btn" href="/entry-history/month/month.php">month</a>
			<a class="mobile-btn current-page" href="/entry-history/day/day.php">day</a>
			<a class="mobile-btn" id="account-nav-button" href="/account/account.php">account</a>
            <a class="mobile-btn" href="/logout/logout.php" rel="ajax:modal">logout</a>
		</div>

		<div class="main">
            <h1 class="align-left">entry history by day</h1>

            <form id="history-from" method="GET" action="day-handler.php" class="align-left">                
                <label>day:</label>
                <input type="date" name="date" min="1990-01-01" required
                <?php
                    date_default_timezone_set('America/Boise');
                    $date = date("Y-m-d");
                    echo "max='{$date}'";
                    echo "value='{$date}'";                        
                ?>/> 
                <input id="get-history" class="button" type="submit" value="view entries"/>
            </form>

            <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='error message'>" . $_SESSION['message'] . "</div>";
                }
                unset($_SESSION['message']);
            ?>

            <div class="result <?php echo isset($_SESSION['show']) ? $_SESSION['show'] : ''; ?>">
                <div class="date"><b>History for <?php echo isset($_SESSION['date']) ? date_format(new DateTime($_SESSION['date']), 'F jS Y') : 'no date'; ?></b></div>
               
                <div id="main-table-scroll" class="table-scroll">
                    <div class="entry-table table-wrap">
                        <table class="main-table">
                            <tr>
                                <td class="fixed-side" id="top-y-value">12am</td>
                            </tr>
                            <form id="entries" class="align-left">
                                <tr>
                                    <td class="y-axis fixed-side">6pm</td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'left', 'ankle') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'right', 'ankle') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'left', 'knee') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'right', 'knee') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'left', 'hip') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'right', 'hip') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'left', 'hand') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'right', 'hand') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'left', 'wrist') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'right', 'wrist') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'left', 'elbow') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'right', 'elbow') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'left', 'shoulder') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time4', 'right', 'shoulder') ?></td>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">12pm</td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'left', 'ankle') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'right', 'ankle') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'left', 'knee') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'right', 'knee') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'left', 'hip') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'right', 'hip') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'left', 'hand') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'right', 'hand') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'left', 'wrist') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'right', 'wrist') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'left', 'elbow') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'right', 'elbow') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'left', 'shoulder') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time3', 'right', 'shoulder') ?></td>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">6am</td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'left', 'ankle') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'right', 'ankle') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'left', 'knee') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'right', 'knee') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'left', 'hip') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'right', 'hip') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'left', 'hand') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'right', 'hand') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'left', 'wrist') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'right', 'wrist') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'left', 'elbow') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'right', 'elbow') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'left', 'shoulder') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time2', 'right', 'shoulder') ?></td>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">12am</td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'left', 'ankle') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'right', 'ankle') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'left', 'knee') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'right', 'knee') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'left', 'hip') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'right', 'hip') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'left', 'hand') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'right', 'hand') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'left', 'wrist') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'right', 'wrist') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'left', 'elbow') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'right', 'elbow') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'left', 'shoulder') ?></td>
                                    <td <?php $e->getClassAndCount_Day('time1', 'right', 'shoulder') ?></td>                        
                                </tr>
                            </form>
                            <tr>
                                <td class="fixed-side">&nbsp;</td>
                                <td class="x-axis">left</td>
                                <td class="x-axis">right</td>
                                <td class="x-axis">left</td>
                                <td class="x-axis">right</td>
                                <td class="x-axis">left</td>
                                <td class="x-axis">right</td>
                                <td class="x-axis">left</td>
                                <td class="x-axis">right</td>
                                <td class="x-axis">left</td>
                                <td class="x-axis">right</td>
                                <td class="x-axis">left</td>
                                <td class="x-axis">right</td>
                                <td class="x-axis">left</td>
                                <td class="x-axis">right</td>
                            </tr>   
                            <tr>
                                <td class="fixed-side">&nbsp;</td>
                                <td colspan="2">ankle</td>
                                <td colspan="2">knee</td>
                                <td colspan="2">hip</td>
                                <td colspan="2">hand</td>
                                <td colspan="2">wrist</td>
                                <td colspan="2">elbow</td>
                                <td colspan="2">shoulder</td>
                            </tr>   
                        </table>
                    </div>                    
                </div>            
                
                <div class="key">
                    Key: <img id="question-button" class="question-button" src="/img/question.png" width="15px" height="15px"/>
                    <div>
                        <div id="display-key">
                            <div>
                                color: average pain level 
                                    <span class="painOne pain-colors">1</span><span class="painTwo pain-colors">2</span><span class="painThree pain-colors">3</span><span class="painFour pain-colors">4</span><span class="painFive pain-colors">5</span>
                            </div>      
                            <div>
                                #: number of entries (can click for details)
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="summary">    
                    <div class="summary-section">
                        <div><b>pain level</b></div>
                        <span>average: <?php echo $_SESSION['painStats']['Avg']; ?></span>
                        <span>min: <?php echo $_SESSION['painStats']['Min']; ?></span>
                        <span>max: <?php echo $_SESSION['painStats']['Max']; ?></span>
                    </div>  
                    <div class="summary-section">
                        <div><b>number of entries per side</b></div>
                        <table>
                            <tbody>
                                <tr>
                                    <td style="text-align: left;">left: <?php echo $e->countBySide('left') . " (" . $e->percentBySide() . "%)"; ?></td>
                                    <td style="text-align: right;"><?php echo $e->countBySide('right') . " (" . (100 - $e->percentBySide()) . "%)"; ?> :right</td>
                                </tr>
                                <tr>
                                    <td style="background: linear-gradient(to right, var(--second-color) <?php echo $e->percentBySide(); ?>%, var(--first-color) 0%);"
                                        colspan="2" class="joint-percent-bar">&nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>   
                </div>
            </div>  
            
            <div class="result <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''; ?>">
                No entries found for the day: <?php echo isset($_SESSION['date']) ? date_format(new DateTime($_SESSION['date']), 'F jS Y') : 'no date'; ?>
            </div>

        </div>
        <div class="footer">
            <div class="footer-content">
                <hr/>
                arthritis tracker | ally oliphant | 2019
            </div>				
		</div>
	</body>
</html>

<?php
    unset($_SESSION['show']); 
    unset($_SESSION['painStats']);
    unset($_SESSION['error']);
?>