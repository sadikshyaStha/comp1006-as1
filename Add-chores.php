<?php 
$title = 'Add chores';
include('shared/header.php'); ?>

<h2>Add new chores</h2>
<form method="post" action="insert-chores.php">
    <fieldset>
        <label for="Type">Type: *</label>
        <input name="Type" id="Type" required />
    </fieldset>
    <fieldset>
        <label for="DoneBy">Done By: *</label>
        <input name="DoneBy" id="DoneBy" required />
    </fieldset>
    <fieldset>
        <label for="StartTime">Start Time: *</label>
        <input name="StartTime" id="StartTime" required />
    </fieldset>
    <fieldset>
        <label for="EndTime">End Time: *</label>
        <input name="EndTime" id="End Time" required />
    </fieldset>
    <button>Submit</button>
</form>
</body>
</html>