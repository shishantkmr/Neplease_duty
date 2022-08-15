<?php
include('link.php');

mysqli_query($con,"Delete From duty WHERE id='" . $_GET['id'] . "'");


 
  echo " <script> window.location.href='duty_list.php';</script>";
  exit;
