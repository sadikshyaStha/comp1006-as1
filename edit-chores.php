<?php 
$title = 'Edit Chores';
include('shared/header.php'); 

$choresId = $_GET['ChoresId'];

$Type = null;
$DoneBy = null;
$StartTime = null;
$EndTime = null;


if (is_numeric($choresId)) {


    include('shared/db.php');

    $sql = "SELECT * FROM Chores WHERE ChoresId = :ChoresId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':ChoresId', $choresId, PDO::PARAM_INT);
    $cmd->execute();
    $chores = $cmd->fetch(); 

    $Type = $chores['Type'];
    $DoneBy = $chores['DoneBY'];
    $StartTime = $chores['StartTime'];
    $EndTime = $chores['EndTime'];
}

?>

<h2>Edit Show Details</h2>
<form method="post" action="update-show.php">
    <fieldset>
        <label for="Type">Type: *</label>
        <input Type="Type" id="Type" required value="<?php echo $Type; ?>" />
    </fieldset>
    <fieldset>
        <label for="DoneBy">DoneBy: *</label>
        <select name="DoneBy" id="DoneBy" required >
    </fieldset>
    <fieldset>
        <label for="$StartTime">StartTime: *</label>
        <input name="StartTime" id="StartTime" required value="<?php echo $DoneBy; ?>"/>
    </fieldset>
    <fieldset>
        <label for="EndTime">EndTime: *</label>
        <input name="EndTime" id="EndTime" required value="<?php echo $DoneBy; ?>" />
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
    <input type="hidden" name="ChoresId" id="ChoresId" value="<?php echo $choresId; ?>" />
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>