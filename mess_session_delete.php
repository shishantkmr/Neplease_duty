<?php
include('link.php');

// get the last id which is last date one open and close date (mess expenses_table)
$get_last_date_id = mysqli_query($con,"SELECT * FROM mess_user_paid where opn_cls_date IS NOT NULL  order by id desc");
$last_date_list_id = mysqli_fetch_array($get_last_date_id);
$last_date_id = $last_date_list_id['id'];

mysqli_query($con,"Delete From mess_push WHERE id='" . $_GET['id'] . "'");
mysqli_query($con,"Delete From mess_user_paid WHERE id='" . $_GET['id'] . "'");


 $message = "Your message has been deleted ";
  echo " <script> window.location.href='mess_post.php?message=$message';</script>";
  exit;
