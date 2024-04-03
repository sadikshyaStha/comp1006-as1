<?php 
include('shared/auth.php');
$title = 'Add Show';
include('shared/header.php'); ?>

<h2>Add New Chores</h2>
<form method="post" action="insert-chores.php" enctype="multipart/form-data">
<fieldset>
        <label for="Type">Type: *</label>
        <input type="text" name="Type" placeholder="Type" required />
    </fieldset>
    <fieldset>
        <label for="StartTime">Start Time: *</label>
        <input name="StartTime" id="StartTime" required />
    </fieldset>
    <fieldset>
        <label for="EndTime">End Time: *</label>
        <input name="EndTime" id="EndTime" required />
    </fieldset>
    <fieldset>
    <label for="DoneBy">Done By: *</label>
        <select name="DoneBy" id="DoneBy" required>
            <?php
            // connect
            try {
                // connect
                include('shared/db.php');
            // set up & run query, store data results
              $sql = "SELECT * FROM DoneBy ORDER BY name";
              $cmd = $db->prepare($sql);
               $cmd->execute();
              $DoneBy = $cmd->fetchAll();
              foreach ($DoneBy as $DoneBy) {
                echo '<option>' . $DoneBy['name'] . '</option>';
            }
              // disconnect
            $db = null;
            }
            catch (Exception $err) {
                header('location:error.php');
                exit();
            }
            ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*"  />
    </fieldset>
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>