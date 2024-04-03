<?php
include('shared/auth.php');
$title = 'Show Chores';
include('shared/header.php');
try {
    // connect
    include('shared/db.php');

   $sql = "SELECT ChoresID, Type, photo, StartTime, EndTime, DoneBy FROM Chores"; 
    $cmd = $db->prepare($sql);
    // run query & store results in var called $schores
   $cmd->execute();
    $schores = $cmd->fetchAll();
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}

// start the list
echo '<h1>Show Chores</h1>';
echo '<table><thead><th>Type</th><th>Photo</th><th>StartTime</th><th>EndTime</th><th>DoneBy</th>';
if (!empty($_SESSION['username'])) {
    echo '<th>Actions</th>';
}
echo '</thead><tbody>';

// loop through the data result from the query, and display each chore
foreach ($schores as $chore) {
    echo '<tr>
        <td>' . $chore['Type'] . '</td>
        <td>';
        if ($chore['photo'] != null) {
            echo '<img src="img' . $chore['photo'] . '" class="thumbnail"  />';
        }
        echo '</td>
        <td>' . $chore['StartTime'] . '</td>
        <td>' . $chore['EndTime'] . '</td>
        <td>' . $chore['DoneBy'] . '</td>';
        if (!empty($_SESSION['username'])) {
            echo '<td class="actions">
                <a href="edit-chores.php?ChoresID=' . $chore['ChoresID'] . '">
                    Edit
                </a>&nbsp;
                <a href="delete-chores.php?ChoresID=' . $chore['ChoresID'] . '" onclick="return confirmDelete();">
                    Delete
                </a>
            </td>';
        }
        echo '</tr>';
}

// If $schores is empty, display a message
if (empty($schores)) {
    echo '<tr><td colspan="6">No chores found.</td></tr>';
}

// end list
echo '</table>';
// disconnect
$db = null;
?>
</main>
</body>
</html>
