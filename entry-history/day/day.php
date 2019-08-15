<?php
    session_cache_limiter('public');
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
        <link rel="stylesheet" href="/entry-history/day/day.css">
        <script src="/js/min/jquery.validate.min.js"></script>
        <script src="/js/min/entry-history.min.js"></script>
	</header>		
	<body>
		<?php $page->navigation('day'); ?>	

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
                                    <?php $e->getClassAndCount_Day('time4') ?>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">12pm</td>
                                    <?php $e->getClassAndCount_Day('time3') ?>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">6am</td>
                                    <?php $e->getClassAndCount_Day('time2') ?>
                                </tr>
                                <tr>
                                    <td class="y-axis fixed-side">12am</td>
                                    <?php $e->getClassAndCount_Day('time1') ?>                       
                                </tr>
                            </form>
                            <tr>
                                <td class="fixed-side">&nbsp;</td>
                                <?php 
                                    for ($i = 0; $i < 7; $i++) {
                                        echo "<td class='x-axis'>left</td>";
                                        echo "<td class='x-axis'>right</td>";
                                    }
                                ?>
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
                </div>
            </div>  
            
            <div class="result <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''; ?>">
                No entries found for the day: <?php echo isset($_SESSION['date']) ? date_format(new DateTime($_SESSION['date']), 'F jS Y') : 'no date'; ?>
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
?>