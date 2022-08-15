<?php
include('link.php');

mysqli_query($con,"UPDATE users set  role='1'   WHERE id='" . $_POST['user'] . "'");


 
  echo " <script> window.location.href='permission.php';</script>";
  exit;


?>