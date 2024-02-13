<?php
$title = 'Saving New Chores...';
include('shared/header.php');
// capture form inputs into vars
$Type = $_POST['Type'];
echo $Type;
$DoneBy = $_POST['DoneBy'];
$StartTime = $_POST['StartTime'];
$EndTime = $_POST['EndTime'];
$ok = true;
// input validation before save
if (empty($Type)) {
    echo 'Type is required<br />';
    $ok = false;
}
if (empty($DoneBy)) {
    echo 'DoneBy is required<br />';
    $ok = false;
}

if (empty($StartTime)) {
    echo 'StartTime is required<br />';
    $ok = false;
}
else {
    if (is_numeric($StartTime)) {
        if ($StartTime < 1) {
            echo 'StartTime must be over than 1';
            $ok = false;
        }
    }
    else {
        echo 'StartTime must be a number > 1';
        $ok = false;
    }
}
if (empty($EndTime)) {
    echo 'EndTime is required<br />';
    $ok = false;
} else {
    if (!is_numeric($EndTime)) {
        echo 'EndTime must be a number<br />';
        $ok = false;
    }
}

if ($ok == true) {

    include('shared/db.php');
    $sql = "INSERT INTO Chores (Type, DoneBy, StartTime, EndTime) VALUES (:Type, :DoneBy, :StartTime, :EndTime)";
    // link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);
    // map each input to a column in the shows table
    $cmd->bindParam(':Type', $Type, PDO::PARAM_STR, 100);
    $cmd->bindParam(':DoneBy', $DoneBy, PDO::PARAM_STR);
    $cmd->bindParam(':StartTime', $StartTime, PDO::PARAM_INT);
    $cmd->bindParam(':EndTime', $EndTime, PDO::PARAM_INT);
    // execute the INSERT (which saves to the db)
    $cmd->execute();
    // disconnect
    $db = null;
    // show msg to user
    echo 'Chores Added';
}
?>
</main>
</body>
</html>