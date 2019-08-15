<?php
	session_start();

	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$_SESSION['message'] = "Please login to view";
		header("Location: /login/login.php");
		exit();
	}

    require_once '../Entry.php';
    include_once '../../Page.php';
    $e = new Entry();
    $page = new Page();
?>

<html>
	<header>
		<?php $page->header(true); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
        <link rel="stylesheet" href="/entry-history/entry-history.min.css">
        <link rel="stylesheet" href="/entry-history/year/year.css">
        <script src="/js/min/jquery.validate.min.js"></script>
        <script src="/js/min/entry-history.min.js"></script>    
	</header>		
	<body>
		<?php $page->navigation('year'); ?>	

		<div class="main">
            <h1 class="align-left">entry history by year</h1>

            <form id="history-from" method="GET" action="year-handler.php" class="align-left">
                <label>year:</label>
                <input type="number" min="1990" name="date" required
                <?php
                    date_default_timezone_set('America/Boise');
                    $date = date("Y");
                    echo "max='{$date}'";
                    echo "value='{$date}'";                        
                ?>/>
                <input id="get-history" class="button" type="submit" value="view entries"/>
            </form>

            <?php
                if (isset($_SESSION['message'])) {
                    echo "<div class='error message'>" . $_SESSION['message'] . "</div>";
                }
            ?>

            <div class="result <?php echo isset($_SESSION['show']) ? $_SESSION['show'] : ''; ?>">
                <div class="date"><b>History for the year <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date'; ?></b></div>
                
                <div id="main-table-scroll" class="table-scroll">
                    <div class="entry-table table-wrap">
                        <table class="main-table">
                            <tr>
                                <td class="fixed-side" id="top-y-value">12am</td>
                            </tr>
                            <form id="entries" class="align-left">
                                <tr>
                                    <td class="y-axis fixed-side">6pm</td>
                                    <?php $e->getClassAndCount_Year('time4'); ?>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">12pm</td>
                                    <?php $e->getClassAndCount_Year('time3'); ?>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">6am</td>
                                    <?php $e->getClassAndCount_Year('time2'); ?>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">12am</td>
                                    <?php $e->getClassAndCount_Year('time1'); ?>
                                </tr>
                            </form>
                            <tr>
                                <form method="GET" action="/entry-history/month/month-handler.php" class="align-left">
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
                        <span>average: <?php echo isset($_SESSION['painStats']['Avg']) ? $_SESSION['painStats']['Avg'] : 0; ?></span>
                        <span>min: <?php echo isset($_SESSION['painStats']['Min']) ? $_SESSION['painStats']['Min'] : 0; ?></span>
                        <span>max: <?php echo isset($_SESSION['painStats']['Max']) ? $_SESSION['painStats']['Max'] : 0; ?></span>
                    </div>  
                    <div class="summary-section">
                        <div><b>number of entries per side</b></div>
                        <table>
                            <tbody>
                                <tr>
                                    <td style="text-align: left;">left: <?php echo $e->countBySide('left') . " (" . $e->leftPercent() . "%)"; ?></td>
                                    <td style="text-align: right;"><?php echo $e->countBySide('right') . " (" . (100 - $e->leftPercent()) . "%)"; ?> :right</td>
                                </tr>
                                <tr>
                                    <td style="background: linear-gradient(to right, var(--second-color) <?php echo $e->leftPercent(); ?>%, var(--first-color) 0%);"
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
                                            <?php $e->summaryJointTable('Ankle'); ?> 
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>knee</span></td>
                                            <?php $e->summaryJointTable('Knee'); ?>
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>hip</span></td>
                                            <?php $e->summaryJointTable('Hip'); ?>
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>hand</span></td>
                                            <?php $e->summaryJointTable('Hand'); ?>
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>wrist</span></td>
                                            <?php $e->summaryJointTable('Wrist'); ?>
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>elbow</span></td>
                                            <?php $e->summaryJointTable('Elbow'); ?>
                                        </tr>
                                        <tr><td></td><td class=" fixed-side y-axis"></td></tr>
                                        <tr>
                                            <td rowspan="2" class="summary-joint fixed-side rotate"><span>shoulder</span></td>
                                            <?php $e->summaryJointTable('Shoulder'); ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>  
                        <div class="key">
                            Key: <img id="summary-question-button" class="question-button" src="/img/question.png" width="15px" height="15px"/>
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
            
            <div class="result <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''; ?>">
                No entries found for the year: <?php echo isset($_SESSION['date']) ? $_SESSION['date'] : 'no date';?>
            </div>  

        </div>
        
        <?php $page->footer(); ?>
	</body>
</html>

<?php
    unset($_SESSION['message']);
    unset($_SESSION['show']);
    unset($_SESSION['painStats']);
    unset($_SESSION['error']);
    unset($_SESSION['left']);
    unset($_SESSION['right']);
    unset($_SESSION['maxJointCount']);
?>