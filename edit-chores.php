<?php 
include('shared/auth.php');
$title = 'Edit Chores';
include('shared/header.php'); 

$ChoresId = $_GET['ChoresID'];

$Type = null;
$DoneBy = null;
$StartTime = null;
$EndTime = null;

if (is_numeric($ChoresId)) {
    try {
        // connect
        include('shared/db.php');

        $sql = "SELECT * FROM Chores WHERE ChoresID = :ChoresID";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':ChoresID', $ChoresId, PDO::PARAM_INT);
        $cmd->execute();
        $chore = $cmd->fetch(); 

        $Type = $chore['Type'];
        $DoneBy = $chore['DoneBy'];
        $StartTime = $chore['StartTime'];
        $EndTime = $chore['EndTime'];
        $photo = $chore['photo'];
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
        <input type="text" id="Type" name="Type" required value="<?php echo $Type; ?>" />
    </fieldset>
    <input type="hidden" name="ChoresID" id="ChoresID" value="<?php echo $ChoresId; ?>" />
    <fieldset>
        <label for="StartTime">StartTime: *</label>
        <input type="text" name="StartTime" id="StartTime" required value="<?php echo $StartTime; ?>"/>
    </fieldset>
    <fieldset>
        <label for="EndTime">EndTime: *</label>
        <input type="text" name="EndTime" id="EndTime" required value="<?php echo $EndTime; ?>" />
    </fieldset>
    <fieldset>
        <label for="DoneBy">DoneBy: *</label>
        <select name="DoneBy" id="DoneBy" required>
            <?php
            // set up & run query, store data results
            $sql = "SELECT * FROM DoneBy ORDER BY name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $doneByOptions = $cmd->fetchAll();

            foreach ($doneByOptions as $option) {
                if ($option['name'] == $DoneBy) {
                    echo '<option selected>' . $option['name'] . '</option>';
                } else {
                    echo '<option>' . $option['name'] . '</option>';
                }    
            }

            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <input type="hidden" name="ChoresID" id="ChoresID" value="<?php echo $ChoresId; ?>" />
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" />
        <input type="hidden" id="currentPhoto" name="currentPhoto" value="<?php echo $photo; ?>" />
        <?php
        if (!empty($photo)) {
            echo '<img src="img/uploads/' . $photo . '" alt="Chores Photo" />';
        }
        ?>
    </fieldset>
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>
