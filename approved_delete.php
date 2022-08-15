<?php
include('link.php');

mysqli_query($con,"UPDATE users set  role='0'   WHERE id='" . $_POST['user'] . "'");


 
  echo " <script> window.location.href='permission.php';</script>";
  exit;


?>

<?php
// include('link.php');

// if(count($_POST)>0) {

//   mysqli_query($con,"UPDATE users set  role='1'   WHERE id='" . $_POST['user'] . "'");

//   $message = "Record Modified Successfully";
  
//   echo " <script> window.location.href='duty_list.php';</script>";
//   exit;
// }
// below code for get value

?>