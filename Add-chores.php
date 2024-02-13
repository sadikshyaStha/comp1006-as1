<?php 
$title = 'Add chores';
include('shared/header.php'); ?>
<!--displayiing the topic-->
<h2>Add new chores</h2>
<!--A form for adding new chores-->
<form method="post" action="insert-chores.php">
     <!--input box for type form-->
<fieldset>
        <label for="Type">Type: *</label>
        <input name="Type" id="Type" required />
    </fieldset>
    <!--input box for starttime form-->
    <fieldset>
        <label for="StartTime">Start Time: *</label>
        <input name="StartTime" id="StartTime" required />
    </fieldset>
    <!--input box for endtime form-->
    <fieldset>
        <label for="EndTime">End Time: *</label>
        <input name="EndTime" id="End Time" required />
    </fieldset>
    <fieldset>
        <!--Dropdown box to cboose who will do the chores-->
        <label for="DoneBy">Done By: *</label>
        <select name="DoneBy" id="DoneBy" required>
            <?php
            //Connecting to the database
            include('shared/db.php');
            //Query to select the name from DoneBy
            $sql = "SELECT * FROM DoneBy ORDER BY name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $DoneBy = $cmd->fetchAll();
          //creating a loop through each name and creating an option to have a dropdown menu
            foreach ($DoneBy as $DoneBy) {
                echo '<option>' . $DoneBy['name'] . '</option>';
            }
           //closing the database connection
            $db = null;
            ?>
        </select>
    </fieldset>
   <!--Submit button for the form-->
    <button class="offset-button">Submit</button>
</form>
</body>
</html>