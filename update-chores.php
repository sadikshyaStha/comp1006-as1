<?php
$title = 'Saving Chores Updates...';
include('shared/header.php');

// capture form inputs into vars
$choreId = $_POST['ChoresId'];  // id value from hidden input on form
$Type = $_POST['Type'];
$DoneBy = $_POST['DoneBy'];
$StartTime = $_POST['StartTime'];
$EndTime = $_POST['EndTime'];
$ok = true;

// input validation before save
if (empty($Type)) {
    echo 'Type is mandatory<br/>';
    $ok = false;
}
if (empty($DoneBy)) {
    echo 'DoneBy is mandatory<br/>';
    $ok = false;
}
if (empty($StartTime)) {
    echo 'StartTime is mandatory<br/>';
    $ok = false;
}
else {
    //Giving statements if the starttime is numeric or not
    if (is_numeric($StartTime)) {
        if ($StartTime < 1) {
            echo 'StartTime must be numeric ';
            $ok = false;
        }
    }
    else {
        echo 'StartTime must be numeric > 1';
        $ok = false;
    }
}
if (empty($EndTime)) {
    echo 'EndTime is mandatory<br />';
    $ok = false;
}

// when the inputs are valid,it is used to save the data to the database
if ($ok == true) {
    // connect to db using the PDO (PHP Data Objects Library)
    include('shared/db.php');


    // set up SQL UPDATE command
    $sql = "UPDATE Chores SET Type = :Type, DoneBy = :DoneBy, 
        StartTime = :StartTime, EndTime = :EndTime WHERE ChoresId = :ChoresId";

    // link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);

    // map each input to a column in the shows table
    $cmd->bindParam(':Type', $Type, PDO::PARAM_STR, 100);
    $cmd->bindParam(':DoneBy', $DoneBy, PDO::PARAM_STR);
    $cmd->bindParam(':StartTime', $StartTime, PDO::PARAM_INT);
    $cmd->bindParam(':EndTime', $EndTime, PDO::PARAM_INT);
    $cmd->bindParam(':ChoresId', $choreId, PDO::PARAM_INT);

    // execute the update (which saves to the db)
    $cmd->execute();

    // disconnect
    $db = null;

    // show msg to user
    echo 'Chores Updated';
}
?>
</main>
</body>
</html>