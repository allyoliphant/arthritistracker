<?php
    session_start();

    $get = isset($_GET['entry']) ? $_GET['entry'] : '';
    $entryValues = explode(' ', $get);
    $time = $entryValues[0];
    $pattern = $entryValues[1];
?>


<div class="modal">
    <table>
        <tr>
            <td class="bottom-border">side</td>
            <td class="bottom-border">joint</td>
            <td class="bottom-border">pain</td>
            <td class="bottom-border">time</td>
            <td class="bottom-border">date</td>
            <td class="bottom-border">edit</td>
        </tr>  

        <?php
            foreach ($_SESSION[$time] as $entry) {
                if (preg_match($pattern, $entry['Date'])) {
                    echo "<tr>";
                    echo "<td>" . $entry['Side'] . "</td>";
                    echo "<td> " . $entry['Joint'] . "</td>";
                    echo "<td>" . $entry['PainLevel'] . "</td>";
                    echo "<td>" . date_format(new DateTime($entry['Time']), 'g:ma') . "</td>";
                    echo "<td>" . date_format(new DateTime($entry['Date']), 'm/d/y') . "</td>";
                    echo "<td><a href='#entry-edit' rel='modal:open' class='no-style-link'>
                        <i class='material-icons' style='font-size:14px'>edit</i>
                        </a></td>";
                    echo "</tr>";
                }
            }  
        ?>
    </table>
</div>