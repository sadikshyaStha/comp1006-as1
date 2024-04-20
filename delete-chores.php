<?php
include('shared/auth.php');
// read the showId from the url parameter using $_GET   
$ChoresId= $_GET['ChoresId'];

if (is_numeric($ChoresId)) {
    // connect to db
    include('shared/db.php');
    try {
        // connect to db
        include('shared/db.php');
    // prepare SQL DELETE
         $sql = "DELETE FROM Chores WHERE ChoresId = :ChoresId";
        $cmd = $db->prepare($sql);
         $cmd->bindParam(':ChoresId', $ChoresId, PDO::PARAM_INT);

    // execute the delete
         $cmd->execute();

    // disconnect
         $db = null;

    // show a message (temporarily)
        echo 'Chores Deleted';

      // redirect back to updated shows.php (eventually)
       header('location:Chores-Tables.php');
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}

?>