<?php
if (isset($_SESSION['email'])){
	$T_UserName=$_SESSION['email'];
}
if (isset($_GET['id'])){
	$loginid=$_GET['id'];

//Get  login username if using GET
	$loginid=mysql_real_escape_string($loginid);
	$query = "SELECT `id` FROM `users` WHERE id=$loginid";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$role = $row['role'];
	$T_UserName=$row['id'];
	

	
	

}

include('link.php');
$result = mysqli_query($con,"SELECT * FROM users where email = '" . $T_UserName. "'");
$row_id= mysqli_fetch_array($result);
$user_name = $row_id['username'];
$user_role = $row_id['role'];
$user_email = $row_id['email'];
$user_cmp = $row_id['cmp_name'];
$user_id =$row_id['id'];// mess_post uses this line
$member = $row_id['mess_member'];
// shis, data fetchng from database
$shis_result = mysqli_query($con,"SELECT * FROM users where email = 'Shishantkmrs@gmail.com' ");
$shis_row= mysqli_fetch_array($shis_result);
$shis_email = $shis_row['email'];
$shis_cmp = $shis_row['cmp_name'];


?>