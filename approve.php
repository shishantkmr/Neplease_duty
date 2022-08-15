<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include('links.php');
// Attempt insert query execution
try{
    // Create prepared statement
   
    $sql = "INSERT INTO users (user_id, date_at, hours,remark) VALUES (:user_id, :date, :hour, :remark)";
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters to statement
 
    $stmt->bindParam(':user_id', $_REQUEST['user_id']);
    $stmt->bindParam(':date', $_REQUEST['date']);
    $stmt->bindParam(':hour', $_REQUEST['hour']);
    $stmt->bindParam(':remark', $_REQUEST['remark']);
    
    // Execute the prepared statement

    $stmt->execute();
    $message =urlencode( "Records inserted successfully.");
    header('location:duty_post.php?message='.$message);
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close connection
unset($pdo);
?>