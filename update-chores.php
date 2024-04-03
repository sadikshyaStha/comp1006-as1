<?php
include('shared/auth.php');
$title = 'Saving Chores Updates...';
include('shared/header.php');


// capture form inputs into vars
$ChoresId = $_POST['ChoresID'];  // id value from hidden input on form
$Type = $_POST['Type'];
$DoneBy = $_POST['DoneBy'];
$StartTime = $_POST['StartTime'];
$EndTime = $_POST['EndTime'];
$ok = true;

// input validation before save
if (empty($Type)) {
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
if ($_FILES['photo']['size'] > 0) { 
    $photoName = $_FILES['photo']['name'];
    $finalName = session_id() . '-' . $photoName;
    //echo $finalName . '<br />';

    // in php, file size is bytes (1 kb = 1024 bytes)
    $size = $_FILES['photo']['size']; 
    //echo $size . '<br />';

    // temp location in server cache
    $tmp_name = $_FILES['photo']['tmp_name'];
    //echo $tmp_name . '<br />';

    // file type
    // $type = $_FILES['photo']['type']; // never use this - unsafe, only checks extension
    $type = mime_content_type($tmp_name);
    //echo $type . '<br />';

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    }
    else {
        // save file to img/uploads
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }     
}
else {
    $finalName = $_POST['currentPhoto'];
}

if ($ok == true) {
    // connect to db using the PDO (PHP Data Objects Library)
    try {
        // connect to db using the PDO (PHP Data Objects Library)
        include('shared/db.php');

       // set up SQL UPDATE command
      $sql = "UPDATE ChoresID SET Type = :Type, DoneBy = :DoneBy, 
        StartTime = :StartTime, EndTime = :EndTime WHERE photo = :photo ChoresID = :ChoresID";
       

       // link db connection w/SQL command we want to run
       $cmd = $db->prepare($sql);

       // map each input to a column in the shows table
       $cmd->bindParam(':Type', $name, PDO::PARAM_STR, 100);
       $cmd->bindParam(':DoneBy', $DoneBy, PDO::PARAM_STR,100);
       $cmd->bindParam(':StartTime', $StartTime, PDO::PARAM_INT);
       $cmd->bindParam(':EndTime', $EndTime, PDO::PARAM_INT);
       $cmd->bindParam(':ChoresID', $ChoresId, PDO::PARAM_INT);
       $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

       // execute the update (which saves to the db)
       $cmd->execute();

       // disconnect
       $db = null;

        // show msg to user
         echo 'Chores Updated';
    }
       catch (Exception $err) {
         header('location:error.php');
         exit();
         }
}
?>
</main>
</body>
</html>