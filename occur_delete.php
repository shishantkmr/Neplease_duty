<?php
include('link.php');

mysqli_query($con,"Delete From occur_day WHERE ids='" . $_GET['id'] . "'");


 $message = "Record Deleted Successfully";

      echo " <script> window.location.href='anually_todo_post.php?message=$message';</script>";
 
  exit;
