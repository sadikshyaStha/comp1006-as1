<?php
$title = 'Saving New Chores...';
include('shared/header.php');

//Receiving the form data
$Type = $_POST['Type'];
$DoneBy = $_POST['DoneBy'];
$StartTime = $_POST['StartTime'];
$EndTime = $_POST['EndTime'];
$ok = true;

//Validating the form inputs
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

    include('shared/db.php');
    $sql = "INSERT INTO Chores (Type, DoneBy, StartTime, EndTime) VALUES (:Type, :DoneBy, :StartTime, :EndTime)";
    
    //Preparing and executing the SQL statements
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':Type', $Type, PDO::PARAM_STR, 100);
    $cmd->bindParam(':DoneBy', $DoneBy, PDO::PARAM_STR);
    $cmd->bindParam(':StartTime', $StartTime, PDO::PARAM_INT);
    $cmd->bindParam(':EndTime', $EndTime, PDO::PARAM_INT);
    $cmd->execute();
  
    //ending the databse connection
    $db = null;
   
    //if it works give this message
    echo '-Added in the chores';
}
?>
</main>
</body>
</html>