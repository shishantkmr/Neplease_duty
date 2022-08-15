<?php include('assets/lib/header.php'); ?>
<?php

if (isset($_SESSION['email'])){
	$T_UserName=$_SESSION['email'];
}
if (isset($_GET['id'])){
	$loginid=$_GET['id'];

//Get  login username if using GET
	$loginid=mysql_real_escape_string($loginid);
	$query = "SELECT `id` FROM `users` WHERE id=$loginid order by date_at desc";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$T_UserName=$row['id'];
	
}
?>



<?php
include('link.php');
$result = mysqli_query($con,"SELECT * FROM users where email = '" . $T_UserName. "'");
$row_id= mysqli_fetch_array($result);
$user_id = $row_id['id'];
// $result = mysqli_query($con,"SELECT MONTHNAME(date_at) as mname, sum(hours) as total from duty GROUP BY MONTH(date_at)");
// $result = mysqli_query($con,"SELECT sum('hours') FROM duty where MONTH('date_at') = MONTH(now()) ");
$result = mysqli_query($con,"SELECT count(hours) as 'days', sum(hours) as 'sums' FROM duty where MONTH(date_at) = MONTH(now())  And user_id = $user_id  ");


$list = mysqli_query($con,"SELECT *  FROM duty where  MONTH(date_at) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) and YEAR(date_at) = YEAR(now()) And user_id = $user_id order by date_at asc");

$year_month = mysqli_query($con,"SELECT *  FROM mess_push   GROUP BY YEAR(post_date), MONTH(post_date) order by post_date desc"); // just for month

$year_months = mysqli_query($con,"SELECT *  FROM mess_push   GROUP BY YEAR(post_date) order by post_date desc"); // Year for selection box




$all = mysqli_query($con,"SELECT * FROM duty ");// all the value

$before_one_month =mysqli_query($con, "SELECT  MONTH(date_at) AS month, SUM(hours) AS hour
	FROM duty WHERE date_at > DATE_SUB(NOW(), INTERVAL 1 month)");
$row_before_onemonth = mysqli_fetch_array($before_one_month);



$Current_month = mysqli_query($con,"SELECT date_at FROM duty where MONTH(date_at) = MONTH(now()-1) and YEAR(date_at) = YEAR(now())");

// $result = mysqli_query($con,"SELECT EXTRACT(MONTH FROM date_at) as month,EXTRACT(YEAR FROM date_at) as year,
	// SUM(hours) as total FROM duty GROUP BY month, year ORDER BY year DESC, month DESC");
$row = mysqli_fetch_array($result);
$cr_month = mysqli_fetch_array($Current_month);

// $sql =$con->query($result)
?>


<!-- ======= Counts Section ======= -->
<!-- get the data by month name -->
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","mess_get_records.php?q="+str,true);
  xmlhttp.send();
}
</script>

</head>
<body>

<form>

</form>
<br>

<!-- /month name  -->
<section id="team" class="team">
	<div class="container">

		<div class="section-title">
			<h2>Check the All months </h2>
			<p>Here, how much i did </p>
			<p>
				<div class="form-group">
					<div class="form-group col-md-4">
						<label for="inputState">Choose the month</label>
						<form>
						<select id="inputState" name ="month" class="form-control" size="1"  name="users" onchange="showUser(this.value)">
							<option selected disabled>Choose...</option>							
													
							<?php
							while($row = mysqli_fetch_array($year_month)) {


								?>
								<option value="<?php echo $row['post_date'];?>"><?php  echo date("F, Y ",strtotime($row['post_date']));?> </option>
							<?php } ?>
							<?php
							while($row = mysqli_fetch_array($year_months)) {


								?>
								<option value="<?php  echo date("Y ",strtotime($row['post_date']));?>"><?php  echo date("Y ",strtotime($row['post_date']));?> Total Hours </option>
							<?php } ?>

							<option value="all">All Year</option>	
						</select>
						</form>
					</div>	
				</div>
			</p>
		</div>

		<div class="row">

			<div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 " data-aos="fade-up">

			
				<div id="txtHint"><b>Person info will be listed here.</b></div>

				<!-- /all records -->
			</div>

		</div>
		</div>


		<!-- remark -->
		
		<!-- /remark -->
	</section><!-- End Our Team Section -->

	<?php include('footer.php'); ?>


