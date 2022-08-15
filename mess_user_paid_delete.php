<?php
include('link.php');

mysqli_query($con,"Delete From mess_user_paid WHERE id='" . $_GET['id'] . "'");


 
  echo " <script> window.location.href='user_check_paid.php';</script>";
  exit;
