<?php

include('link.php');
// Attempt insert query execution
$user = $_POST['user'];
$date = $_POST['date'];
$money = $_POST['money'];
$remark = $_POST['remark'];
// $remark = $_POST['remark'];
// $sql = "INSERT INTO mess_user_paid (user_id,post_date,given_money)
// VALUES ($user, $date, $money,)";

$sql = "INSERT INTO mess_user_paid (user_id, post_date, given_money,remark)
    VALUES ('".$_POST["user"]."','".$_POST["date"]."','".$_POST["money"]."','".$_POST["remark"]."')";
if ($con->query($sql) === TRUE) {
  $message =urlencode( "Records inserted successfully.");
    header('location:user_money_paid.php?message='.$message);
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
// try{
//     // Create prepared statement
   
//     $sql = "INSERT INTO mess_user_paid (user_id,post_date,given_money,remark) VALUES (:user_id, :post_date, :given_money, :remark)";
//     $stmt = $pdo->prepare($sql);
    
//     // Bind parameters to statement
 
//     $stmt->bindParam(':user_id', $_REQUEST['user_id']);
//     $stmt->bindParam(':post_date', $_REQUEST['date']);
//     $stmt->bindParam(':given_money', $_REQUEST['money']);
//     $stmt->bindParam(':remark', $_REQUEST['remark']);
    
//     // Execute the prepared statement

//     $stmt->execute();
//     $message =urlencode( "Records inserted successfully.");
//     header('location:user_money_paid.php?message='.$message);
// } catch(PDOException $e){
//     die("ERROR: Could not able to execute $sql. " . $e->getMessage());
// }
 
// // Close connection
// unset($pdo);
?>