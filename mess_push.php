<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include('link.php');
$user_id = $_POST['user_id'];
$post_date = $_POST['post_date'];
$spent_money = $_POST['spent_money'];
$remark = $_POST['remark'];
// $curent_date =NOW();
// $sql = "INSERT INTO mess_user_paid (user_id,post_date,given_money)
// VALUES ($user, $date, $money,)";

$sql = "INSERT INTO mess_push (user_id, post_date, spent_money,remark,curent_date)
    VALUES ('".$_POST["user_id"]."','".$_POST["post_date"]."','".$_POST["spent_money"]."','".$_POST["remark"]."',NOW())";
if ($con->query($sql) === TRUE) {
  $message =urlencode( "Records inserted successfully.");
    header('location:mess_post.php?message='.$message);
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();




// Attempt insert query execution
// try{
//     // Create prepared statement
   
//     $sql = "INSERT INTO mess_push (user_id, post_date,spent_money, remark, curent_date ) VALUES (:user_id, :post_date, :spent_money, :remark,NOW())";
//     $stmt = $pdo->prepare($sql);
    
//     // Bind parameters to statement
 
//     $stmt->bindParam(':user_id', $_REQUEST['user_id']);
//     $stmt->bindParam(':post_date', $_REQUEST['post_date']);
//     $stmt->bindParam(':spent_money', $_REQUEST['spent_money']);
//     $stmt->bindParam(':remark', $_REQUEST['remark']);
//     // $stmt->bindParam(':curent_date', $cd, PDO::PARAM_STR);
    
//     // Execute the prepared statement

//     $stmt->execute();
//     $message =urlencode( "Records inserted successfully.");
//     header('location:mess_post.php?message='.$message);
// } catch(PDOException $e){
//     die("ERROR: Could not able to execute $sql. " . $e->getMessage());
// }
 
// // Close connection
// unset($pdo);
?>