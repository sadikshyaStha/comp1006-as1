<?php
$title = 'Chores Tables';
include('shared/header.php');

include('shared/db.php');
//Selecting all data from Chores table
$sql = "SELECT * FROM Chores";
$cmd = $db->prepare($sql);

// executing the sql query
$cmd->execute();
//fetching the results
$chores = $cmd->fetchAll();

echo '<h1>Chores Tables</h1>';
//Creating a table to display data of chores done 
echo '<table><thead><th>Type</th><th>DoneBy</th><th>StartTime</th><th>EndTime</th></thead>';
//looping through each chore tables and displaying its details in row
foreach ($chores as $chores) {
    echo '<tr>
        <td>' . $chores['Type'] . '</td>
        <td>' . $chores['DoneBy'] . '</td>
        <td>' . $chores['StartTime'] . '</td>
        <td>' . $chores['EndTime'] . '</td>
        </tr>';
}
echo '</table>';

//Ending the database connection
$db = null;
?>
</body>
</html>