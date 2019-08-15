<?php
    session_start();

    $entry = json_decode($_GET['entry'], true);
?>

<div class="modal entry-modal">
    <header>
        <script src="/js/min/edit-entry.min.js"></script>
	</header>

    <form id="entry-form" method="POST" action="/entry-history/edit-entry-handler.php" class="align-left">
        <input type="hidden" name="entry-id" value="<?php echo $entry['ID']; ?>" />
        <input id="url-input" type="hidden" name="path" />
        <div>
            <div>side:</div>
            <label><input type="radio" name="side" value="left" required
                <?php echo $entry['Side']=='left' ? "checked" : "";?>
                >left</label>
            <label><input type="radio" name="side" value="right"
                <?php echo $entry['Side']=='right' ? "checked" : "";?>
                >right</label>
        </div>
        <div>
            <div class="label">joint:</div>
            <label><input type="radio" name="joint" value="ankle" required 
                <?php echo $entry['Joint']=='ankle' ? "checked" : "";?>
                >ankle</label> 
            <label><input type="radio" name="joint" value="knee" 
                <?php echo $entry['Joint']=='knee' ? "checked" : "";?>
                >knee</label> 
            <label><input type="radio" name="joint" value="hip" 
                <?php echo $entry['Joint']=='hip' ? "checked" : "";?>
                >hip</label> 
            <label><input type="radio" name="joint" value="hand" 
                <?php echo $entry['Joint']=='hand' ? "checked" : "";?>
                >hand</label> 
            <label><input type="radio" name="joint" value="wrist" 
                <?php echo $entry['Joint']=='wrist' ? "checked" : "";?>
                >wrist</label> 
            <label><input type="radio" name="joint" value="elbow" 
                <?php echo $entry['Joint']=='elbow' ? "checked" : "";?>
                >elbow</label>
            <label><input type="radio" name="joint" value="shoulder" 
                <?php echo $entry['Joint']=='shoulder' ? "checked" : "";?>
                >shoulder</label> 
        </div>
        <div>
            <div class="label">pain level:</div>
            <label><input type="radio" name="pain" value="1" required 
                <?php echo $entry['PainLevel']==1 ? "checked" : "";?>
                >1</label>
            <label><input type="radio" name="pain" value="2" 
                <?php echo $entry['PainLevel']==2 ? "checked" : "";?>
                >2</label>
            <label><input type="radio" name="pain" value="3" 
                <?php echo $entry['PainLevel']==3 ? "checked" : "";?>
                >3</label> 
            <label><input type="radio" name="pain" value="4" 
                <?php echo $entry['PainLevel']==4 ? "checked" : "";?>
                >4</label> 
            <label><input type="radio" name="pain" value="5" 
                <?php echo $entry['PainLevel']==5 ? "checked" : "";?>
                >5</label>  
        </div>
        <div>
            <div class="label">date:</div>
            <input id="new-entry-date" type="date" name="date" min="1990-01-01" required
            <?php
                $value = $entry['Date'];
                echo "value='{$value}'";                        
            ?>/>  
        </div>
        <div>
            <div class="label">time:</div>
            <input id="new-entry-time" type="time" name="time" required
            <?php
                $value = $entry['Time'];
                echo "value='{$value}'";                        
            ?>/>  
        </div>
        <div>
            <a class="button" href="#" rel="modal:close">Cancel</a>
            <input id="edit-entry" class="button" type="submit" value="save"/>  
        </div>
    </form>
</div>