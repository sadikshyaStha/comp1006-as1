<?php
$title = 'Chores Tables';
include('shared/header.php');

include('shared/db.php');

$sql = "SELECT * FROM Chores";
$cmd = $db->prepare($sql);

$cmd->execute();
$Chores = $cmd->fetchAll();

echo '<h1>Chores Tables</h1>';
echo '<table><thead><th>Type</th><th>Done By</th><th>StartTime</th><th>EndTime</th></thead>';

foreach ($Chores as $Chores) {
    echo '<tr><td>' . $Chores['Type'] . '</td></tr>';
    echo '<tr>
        <td>' . $Chores['Type'] . '</td>
        <td>' . $Chores['DoneBy'] . '</td>
        <td>' . $Chores['StartTime'] . '</td>
        <td>' . $Chores['EndTime'] . '</td>
        </tr>';
}

echo '</table>';

$db = null;
?>
</body>
</html>>