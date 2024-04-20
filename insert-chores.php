<?php
include('shared/auth.php');
$title = 'Saving New Chores...';
include('shared/header.php');

if ($_FILES['photo']['size'] > 0) { 
    $photoName = $_FILES['photo']['name'];
    $finalName = session_id() . '-' . $photoName;

    $size = $_FILES['photo']['size'];

    $tmp_name = $_FILES['photo']['tmp_name'];

    $type = mime_content_type($tmp_name);

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    }
    else {
        // save file to img/uploads
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }
}

$Type = $_POST['Type'];
echo $Type;
$DoneBy = $_POST['DoneBy'];
$StartTime = $_POST['StartTime'];
$EndTime = $_POST['EndTime'];
$ok = true;

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
if (empty($EndTime)) {
    echo 'EndTime is mandatory<br/>';
    $ok = false;
}

if ($ok) {
    try {
        include('shared/db.php');
        $sql = "INSERT INTO Chores (Type, DoneBy, StartTime, EndTime, photo) VALUES (:Type, :DoneBy, :StartTime, :EndTime, :photo)";
        
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':Type', $Type, PDO::PARAM_STR);
        $cmd->bindParam(':DoneBy', $DoneBy, PDO::PARAM_STR);
        $cmd->bindParam(':StartTime', $StartTime, PDO::PARAM_STR);
        $cmd->bindParam(':EndTime', $EndTime, PDO::PARAM_STR);
        $cmd->bindParam(':photo', $photoName, PDO::PARAM_STR);
        $cmd->execute();

        $db = null;
        echo 'Added to the chores.';
    } catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
</main>
</body>
</html>
