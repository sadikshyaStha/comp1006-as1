<?php
// 1. capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];

try {
    // 2. connect
    include('shared/db.php');
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    // 3. look for this username
    if (empty($user)) {
        $db = null;
        header('location:login.php?invalid=true');
        exit(); // Stop execution after redirection
    }

    // 4. if we find a user w/this username, check hashed password
    if (!password_verify($password, $user['password'])) {
        $db = null;
        header('location:login.php?invalid=true');
        exit(); // Stop execution after redirection
    }
    
    // login is valid, both username + hashed password match user in db
    // store identity in session object on web server
    session_start(); // accesses the current session on the server
    $_SESSION['username'] = $username;

    $db = null;
    header('location:Chores-Tables.php');
    exit(); // Stop execution after redirection
} catch (PDOException $e) {
    // Handle PDO exceptions (database-related errors)
    // For example, log the error or display a user-friendly message
    // You can customize this based on your application's requirements
    echo "Database error: " . $e->getMessage();
    // Additional handling code can be added here
} catch (Exception $err) {
    // Handle other exceptions (non-database-related errors)
    // For example, log the error or display a user-friendly message
    // You can customize this based on your application's requirements
    echo "Error: " . $err->getMessage();
    // Additional handling code can be added here
}
?>
