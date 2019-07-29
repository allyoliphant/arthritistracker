<?php
	session_start();

	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$_SESSION['message'] = "Please login to view";
		header("Location: ../../login/login.php");
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
        <link rel="stylesheet" href="year.css">
        <script src="../../js/jquery-3.4.0.min.js" type="text/javascript"></script>
        <script src="../../js/jquery.validate.min.js"></script>
        <script src="../../js/footer.js"></script>
        <script src="../../js/entry-history.js"></script>
        <script src="../../js/mobile.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jQuery Modal -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />     
	</header>		
	<body>
		<div class="side nav">
            <a href="../../home/home.php"><img src="../../img/logo.png" width="70px" height="70px"/></a>
            <a class="button" href="../../new-entry/new-entry.php">New Entry</a>
            <p id="history-section-title">entry history</p>
            <a class="button current-page" href="../year/year.php">year</a>
            <a class="button" href="../month/month.php">month</a>
            <a class="button" href="../day/day.php">day</a>
            <a class="button" id="account-nav-button" href="../../account/account.php">my account</a>
            <a class="button" href="../../logout/logout.php">logout</a>
		</div>	
		<div class="mobile nav">	
            <a href="../../home/home.php"><img id="mobile-logo" src="../../img/logo.png" width="40px" height="40px"/></a>	
			<div id="menuToggle">	
				<input type="checkbox" />			
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>	
		<div class="mobile-menu">
			<a class="mobile-btn" href="../../new-entry/new-entry.php">New Entry</a>
			<p id="history-section-title">entry history</p>
			<a class="mobile-btn current-page" href="../../entry-history/year/year.php">year</a>
			<a class="mobile-btn" href="../../entry-history/month/month.php">month</a>
			<a class="mobile-btn" href="../../entry-history/day/day.php">day</a>
			<a class="mobile-btn" id="account-nav-button" href="../../account/account.php">account</a>
			<a class="mobile-btn" href="../../logout/logout.php">logout</a>
		</div>

		<div class="main">
            <h1>entry history by year</h1>

            <form id="history-from" method="GET" action="year-handler.php">
                <label>year:</label>
                <input type="number" min="1990" name="date" required
                <?php
                    date_default_timezone_set('America/Boise');
                    $date = date("Y");
                    echo "max='{$date}'";
                    $year = isset($_SESSION['date']) ? $_SESSION['date'] : $date;
                    echo "value='{$year}'";                        
                ?>/>
                <input id="get-history" class="button" type="submit" value="view entries"/>
            </form>

            <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='error message'>" . $_SESSION['message'] . "</div>";
                }
                unset($_SESSION['message']);
            ?>

            <div class="result <?php echo isset($_SESSION['show']) ? $_SESSION['show'] : ''; 
                unset($_SESSION['show']);?>">
                <div class="date"><b>History for the year <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date'; ?></b></div>
                
                <div id="main-table-scroll" class="table-scroll">
                    <div class="entry-table table-wrap">
                        <table class="main-table">
                            <tr>
                                <td class="fixed-side" id="top-y-value">12am</td>
                            </tr>
                            <form id="entries">
                                <tr>
                                    <td class="y-axis fixed-side">6pm</td>
                                    <?php $e->getClassAndCount_Year('time4', isset($_SESSION['date']) ? $_SESSION['date'] : '0000'); ?>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">12pm</td>
                                    <?php $e->getClassAndCount_Year('time3', isset($_SESSION['date']) ? $_SESSION['date'] : '0000'); ?>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">6am</td>
                                    <?php $e->getClassAndCount_Year('time2', isset($_SESSION['date']) ? $_SESSION['date'] : '0000'); ?>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">12am</td>
                                    <?php $e->getClassAndCount_Year('time1', isset($_SESSION['date']) ? $_SESSION['date'] : '0000'); ?>
                                </tr>
                            </form>
                            <tr>
                                <form method="GET" action="../month/month-handler.php">
                                    <td class="fixed-side">&nbsp;</td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-01"
                                        type="submit" name="date">Jan</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-02"
                                        type="submit" name="date">Feb</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-03"
                                        type="submit" name="date">Mar</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-04"
                                        type="submit" name="date">Apr</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-05"
                                        type="submit" name="date">May</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-06"
                                        type="submit" name="date">Jun</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-07"
                                        type="submit" name="date">Jul</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-08"
                                        type="submit" name="date">Aug</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-09"
                                        type="submit" name="date">Sept</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-10"
                                        type="submit" name="date">Oct</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-11"
                                        type="submit" name="date">Nov</button>
                                    </td>
                                    <td class="x-axis">
                                        <button value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : '0000'; ?>-12"
                                        type="submit" name="date">Dec</button>
                                    </td>
                                </form>
                            </tr>   
                        </table>
                    </div>
                </div>               
                
                <div class="key">
                    Key: <img id="question-button" class="question-button" src="../../img/question.png" width="15px" height="15px"/>
                    <div>
                        <div id="display-key">
                            <div>
                                color: average pain level 
                                    <span class="painOne pain-colors">1</span><span class="painTwo pain-colors">2</span><span class="painThree pain-colors">3</span><span class="painFour pain-colors">4</span><span class="painFive pain-colors">5</span>
                            </div>      
                            <div>
                                #: number of entries
                            </div>
                        </div>
                    </div>
                </div> 
                    
                <div class="summary">    
                    <div class="summary-section">
                        <div><b>pain level</b></div>
                        <span>average: <?php echo isset($_SESSION['painStats']['Avg']) ? $_SESSION['painStats']['Avg'] : 0; ?></span>
                        <span>min: <?php echo isset($_SESSION['painStats']['Min']) ? $_SESSION['painStats']['Min'] : 0; ?></span>
                        <span>max: <?php echo isset($_SESSION['painStats']['Max']) ? $_SESSION['painStats']['Max'] : 0; 
                            unset($_SESSION['painStats']);?></span>
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
                    <div class="summary-section">
                        <div><b>number of entries per joint</b></div>
                        <div id="summary-table-scroll" class="table-scroll">
                            <div class="entry-table table-wrap">
                                <table class="summary-table" data-count-fixed-columns="2">
                                    <tbody>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>ankle</span></td>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['left']) ? $_SESSION['left']['Ankle'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['left']) ? $_SESSION['left']['Ankle'] : 0) , 'left'); ?> 
                                        </tr> 
                                        <tr>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['right']) ? $_SESSION['right']['Ankle'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['right']) ? $_SESSION['right']['Ankle'] : 0) , 'right'); ?> 
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>knee</span></td>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['left']) ? $_SESSION['left']['Knee'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['left']) ? $_SESSION['left']['Knee'] : 0) , 'left'); ?> 
                                        </tr> 
                                        <tr>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['right']) ? $_SESSION['right']['Knee'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['right']) ? $_SESSION['right']['Knee'] : 0) , 'right'); ?> 
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>hip</span></td>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['left']) ? $_SESSION['left']['Hip'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['left']) ? $_SESSION['left']['Hip'] : 0) , 'left'); ?> 
                                        </tr> 
                                        <tr>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['right']) ? $_SESSION['right']['Hip'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['right']) ? $_SESSION['right']['Hip'] : 0) , 'right'); ?> 
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>hand</span></td>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['left']) ? $_SESSION['left']['Hand'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['left']) ? $_SESSION['left']['Hand'] : 0) , 'left'); ?> 
                                        </tr> 
                                        <tr>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['right']) ? $_SESSION['right']['Hand'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['right']) ? $_SESSION['right']['Hand'] : 0) , 'right'); ?> 
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>wrist</span></td>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['left']) ? $_SESSION['left']['Wrist'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['left']) ? $_SESSION['left']['Wrist'] : 0) , 'left'); ?> 
                                        </tr> 
                                        <tr>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['right']) ? $_SESSION['right']['Wrist'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['right']) ? $_SESSION['right']['Wrist'] : 0) , 'right'); ?> 
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>elbow</span></td>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['left']) ? $_SESSION['left']['Elbow'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['left']) ? $_SESSION['left']['Elbow'] : 0) , 'left'); ?> 
                                        </tr> 
                                        <tr>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['right']) ? $_SESSION['right']['Elbow'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['right']) ? $_SESSION['right']['Elbow'] : 0) , 'right'); ?> 
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>shoulder</span></td>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['left']) ? $_SESSION['left']['Shoulder'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['left']) ? $_SESSION['left']['Shoulder'] : 0) , 'left'); ?> 
                                        </tr> 
                                        <tr>
                                            <td class="y-axis fixed-side"><?php echo isset($_SESSION['right']) ? $_SESSION['right']['Shoulder'] : 0; ?></td>
                                            <?php $e->summaryJointTable((isset($_SESSION['maxJointCount']) ? $_SESSION['maxJointCount'] : 0),
                                                (isset($_SESSION['right']) ? $_SESSION['right']['Shoulder'] : 0) , 'right'); ?> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>  
                        <div class="key">
                            Key: <img id="summary-question-button" class="question-button" src="../../img/question.png" width="15px" height="15px"/>
                            <div>
                                <div id="summary-display-key">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>left</td>
                                                <td class="left-bar summary-key-color">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>right</td>
                                                <td class="right-bar summary-key-color">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>        
                    </div> 
                </div>

            </div>   
            
            <div class="result <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : '';
                unset($_SESSION['error']); ?>">
                No entries found for the year: <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date';?>
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
    unset($_SESSION['left']);
    unset($_SESSION['right']);
    unset($_SESSION['maxJointCount']);
?>