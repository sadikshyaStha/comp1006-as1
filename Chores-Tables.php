<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./css/site.css" />
</head>
<body>

<?php
$title = 'Show Chores';
include('shared/header.php');

try {
    // connect
    include('shared/db.php');

    $sql = "SELECT * FROM Chores"; 
    $cmd = $db->prepare($sql);
    // run query & store results in var called $chores
    $cmd->execute();
    $chores = $cmd->fetchAll();
} catch (Exception $err) {
    header('location:error.php');
    exit();
}

echo '<table><thead><th>Type</th><th>Photo</th><th>StartTime</th><th>EndTime</th><th>DoneBy</th>';
if (!empty($_SESSION['username'])) {
    echo '<th>Actions</th>';
}
echo '</thead>';

// loop through the data result from the query, and display each chore
foreach ($chores as $chore) {
    echo '<tr>
        <td>' . $chore['Type'] . '</td>
        <td>';
    if ($chore['photo'] != null) {
        // Corrected variable name from 'thumbnail' to 'photo'
        echo '<img src="img/uploads/' . $chore['photo'] . '" class="thumbnail" />';
    }
    echo '</td>
        <td>' . $chore['StartTime'] . '</td>
        <td>' . $chore['EndTime'] . '</td>
        <td>' . $chore['DoneBy'] . '</td>';
    if (!empty($_SESSION['username'])) {
        echo '<td class="actions">
            <a href="edit-chores.php?ChoresId=' . $chore['ChoresId'] . '">
                Edit
            </a>&nbsp;
            <a href="delete-chores.php?ChoresId=' . $chore['ChoresId'] . '" onclick="return confirmDelete();">
                Delete
            </a>
        </td>';
    }
    echo '</tr>';
}

// end list
echo '</table>';
// disconnect
$db = null;
?>
</main>
</body>
</html>
