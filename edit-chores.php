<?php 
include('shared/auth.php');
$title = 'Edit Chores';
include('shared/header.php'); 

$ChoresId = $_GET['ChoresId'];

$Type = null;
$DoneBy = null;
$StartTime = null;
$EndTime = null;


if (is_numeric($ChoresId)) {


   
    try {
        // connect
        include('shared/db.php');

        $sql = "SELECT * FROM Chores WHERE ChoresId = :ChoresId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':ChoresId', $ChoresId, PDO::PARAM_INT);
        $cmd->execute();
         $chores = $cmd->fetch(); 

         $Type = $chores['Type'];
        $DoneBy = $chores['DoneBy'];
        $StartTime = $chores['StartTime'];
        $EndTime = $chores['EndTime'];
        $photo = $chores['photo'];
    }
  catch (Exception $err) {
      header('location:error.php');
      exit();
    }
}


?>

<h2>Edit Chores Details</h2>
<form method="post" action="update-Chores.php" enctype="multipart/form-data">
    <fieldset>
        <label for="Type">Type: *</label>
        <input name="Type" id="Type" required value="<?php echo $Type; ?>"
    />
    </select>
    </fieldset>
    <input type="hidden" name="ChoresId" id="ChoresId" value="<?php echo $ChoresId; ?>" />
    <fieldset>
    <label for="$StartTime">StartTime: *</label>
        <input name="StartTime" id="StartTime" required value="<?php echo $StartTime; ?>"/>
    </fieldset>
    <fieldset>
    <label for="EndTime">EndTime: *</label>
        <input name="EndTime" id="EndTime" required value="<?php echo $EndTime; ?>" />
    </fieldset>
    <fieldset>
        <label for="DoneBy">DoneBy: *</label>
        <select name="DoneBy" id="DoneBy" required >
            <?php
            // set up & run query, store data results
            $sql = "SELECT * FROM DoneBy ORDER BY name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $DoneBy = $cmd->fetchAll();

            foreach ($DoneBy as $DoneBy) {
                if ($DoneBy['name'] == $DoneBy) {
                    echo '<option selected>' . $DoneBy['name'] . '</option>';
                }
                else {
                     echo '<option>' . $DoneBy['name'] . '</option>';
                }    
            }

            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <input type="hidden" name="ChoresId" id="ChoresId" value="<?php echo $ChoresId; ?>" />
    <fieldset>
    <label for="photo">Photo:</label>
    <input type="file" id="photo" name="photo" accept="image/*" />
    <input type="hidden" id="currentPhoto" name="currentPhoto" value="<?php echo $photo; ?>" />
    <?php
    if ($photo != null) {
        echo '<img src="img/uploads/' . $photo . '" alt="Chores Photo" />';
    } else {
        echo '<p>No photo available.</p>';
    }
    ?>
</fieldset>

    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html> 