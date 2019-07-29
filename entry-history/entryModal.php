<?php
    session_start();

    $get = isset($_GET['entry']) ? $_GET['entry'] : '';
    $entryValues = explode(' ', $get);
    $time = $entryValues[0];

    if (sizeof($entryValues) < 3) {
        $pattern = $entryValues[1];
        $monthOrYear = true;
    } else {
        $side = $entryValues[1];
        $joint = $entryValues[2];
        $monthOrYear = false;
    }
    
?>


<div class="modal entry-modal">
    <header>
        <script>
            $.modal.defaults = {
                closeExisting: true,
                clickClose: false,
                showClose: true,
                showSpinner: true
            };

            $('a[rel="ajax:modal"]').off('click').click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    data: {
                        'entry': $(this).find('input').val()
                    },
                    success: function (newHTML, textStatus, jqXHR) {
                        $('.modal').each(modal => {
                            $('.modal').get(modal).remove();
                        });
                        $(newHTML).appendTo('body').modal();
                    }
                });
                return false;
            });

            $('a[rel="modal:close"]').off('click').click(function () {
                $('.blocker').each(modal => {
                    $('.blocker').get(modal).remove();
                });
                return false;
            });
        </script>     
	</header>	

    <table>
        <tr>
            <td class="bottom-border">side</td>
            <td class="bottom-border">joint</td>
            <td class="bottom-border">pain</td>
            <td class="bottom-border">date</td>
            <td class="bottom-border">time</td>
            <td class="bottom-border">edit</td>
        </tr>  

        <?php
            foreach ($_SESSION[$time] as $entry) {
                $entryString = json_encode($entry);
                
                $correctEntry = $monthOrYear ? preg_match($pattern, $entry['Date']) : ($entry['Side'] == $side && $entry['Joint'] == $joint);

                if ($correctEntry) {
                    echo "<tr class='gray-border'>";
                    echo "<td>" . $entry['Side'] . "</td>";
                    echo "<td> " . $entry['Joint'] . "</td>";
                    echo "<td>" . $entry['PainLevel'] . "</td>";
                    echo "<td>" . date_format(new DateTime($entry['Date']), 'm/d/y') . "</td>";
                    echo "<td>" . date("g:i a", strtotime($entry['Time'])) . "</td>";
                    echo "<td><a href='../entryEdit.php' rel='ajax:modal' class='no-style-link edit'>
                        <input type='hidden' name='entry-value' value='{$entryString}'/>
                        <i class='material-icons' style='font-size:14px'>edit</i>
                        </a></td>";
                    echo "</tr>";
                }
            }  
        ?>
    </table>
</div>