<?php
include('link.php');

mysqli_query($con,"Delete From mess_push WHERE id='" . $_GET['id'] . "'");


 
  echo " <script> window.location.href='mess_ledger.php';</script>";
  exit;
