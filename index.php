<?php include('assets/lib/header.php'); ?>
<?php
// Mail assests
$error = array();

require "mail.php";
// end mail assests
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
$results = mysqli_query($con,"SELECT * FROM users where email = '" . $T_UserName. "'");
$row_id= mysqli_fetch_array($results);
$user_id = $row_id['id'];

$result_card = mysqli_query($con,"SELECT count(hours) as 'days', sum(hours) as 'sums' FROM duty where MONTH(date_at) = MONTH(now()) and YEAR(date_at) = YEAR(now()) And user_id = $user_id And hours<>0 order by id asc");
$card_row = mysqli_fetch_array($result_card);


$list = mysqli_query($con,"SELECT * FROM duty where MONTH(date_at) = MONTH(now()) and YEAR(date_at) = YEAR(now())  And user_id = $user_id order by date_at asc");

$list_remark = mysqli_query($con,"SELECT * FROM duty where MONTH(date_at) = MONTH(now()) and YEAR(date_at) = YEAR(now())  And user_id = $user_id order by date_at asc");


$Current_month = mysqli_query($con,"SELECT date_at FROM duty where MONTH(date_at) = MONTH(now()) and YEAR(date_at) = YEAR(now())  And user_id = $user_id order by id ASC");



$cr_month = mysqli_fetch_array($Current_month);





// just show me on page and sent msg through the gmail 
$today_occur = mysqli_query($con,"SELECT * FROM occur_day where MONTH(occur_date)=MONTH(current_date) AND DAY(occur_date) = DAY(CURRENT_DATE)");



// just take one variable for just me
$today_notify = mysqli_query($con,"SELECT * FROM occur_day where MONTH(occur_date)=MONTH(current_date) AND DAY(occur_date) = DAY(CURRENT_DATE)");
$notify = mysqli_fetch_array($today_notify);


// just for send mail- any one will open page then automatically send mail if date is same
$send_mail = mysqli_query($con,"SELECT * FROM occur_day where MONTH(occur_date)=MONTH(current_date) AND DAY(occur_date) = DAY(CURRENT_DATE)");


// just for take occur date to send msg
$msg_notify = mysqli_query($con,"SELECT * FROM occur_day where MONTH(occur_date)=MONTH(current_date) AND DAY(occur_date) = DAY(CURRENT_DATE)");

$only = mysqli_query($con,"SELECT * FROM confirm_today");
$only_data = mysqli_fetch_array($only);
?>


<?php $i=0;
$j= 1;
if (!$msg_notify) {
	printf("Error: %s\n", mysqli_error($con));
	exit();
}else{
	while($row = mysqli_fetch_array($msg_notify)) {
		if($row['update_date']!=DATE('Y-m-d')&& $row['occur_date']!=$row['occur_post_date']){
// gmail 
			$mail_title= $row['occur_title'] ;
			$mail_msg="<div class='container'>
		
		
			<div class='row'>
			<div class='col-lg-12 color'>

			<div class='letter'>
			".$row['occur_text']."
			</div>
			</div>
			</div>
			<div class='row'>
			<div class='footer col-12 '>
			<div class='col-12 text-center'>
			<p>Thanks For Read</p>
			</div>
			</div>
			</div>
			</div>";
			
					$occur_id =$row['ids']; // get id for occur confirm table
					?>
					<?php 
// sending mail
					send_mail("shishantkmrs@gmail.com",$mail_title,$mail_msg);
					$id = $row['ids'];
					$message_update = ("Update occur_day set update_date = NOW() where ids=$id");
					if($con->query($message_update)===TRUE)
					{

					}
					else
					{
						echo "Error". $message_update ." <br>"  . $con->error;
					}
					// send the data on confirm table
					$sql = "INSERT INTO confirm_today (occur_id, confirm_date)
					VALUES ($occur_id,NOW())";

					if ($con->query($sql) === TRUE) 
					{
						$message =urlencode( "Records inserted successfully.");

					}
					else
					{
						echo "Error: " . $sql . "<br>" . $con->error;
					}
					?>
					
					<?php 
					// send_mail("shishantkmrs@gmail.com",'TODAY OCCASSION',$mail_msg)?>


					<?php $i++; } else{//echo" already match";
				}}}?>
				<!-- ======= Counts Section ======= -->
				<section class="counts section-bg">
					<div class="container">
						<!-- only shishant can see the post -->
						<?php if ( $row_id['email']=='shishantkmrs@gmail.com'){

							?>

							<div class="row justify-content-center">

								
									<?php $i=0;
									$j= 1;
									while($rows = mysqli_fetch_array($today_occur)) {
										$mail_msg ="<b><h3>". $rows['occur_title']."</h3></b>".$rows['occur_text']
										?><div class="card my-2 bg-primary mr-1">
										<div class="card-header text-white font-weight-normal "><?php  echo $rows['occur_title']; ?></div>
										<ul class="list-group list-group-flush">
											<li class="list-group-item"> <?php echo $rows['occur_text']."&nbsp".$rows['occur_date'] ?></li>
										</ul> </div>
										<?php
										$i++;}?>
									
								</div>
							<?php }?>
							<!-- end Occur day -->
							<div class="row justify-content-center">

								<div class="col-lg-3 col-md-6 text-center" data-aos="fade-up">
									<div class="count-box">
										<i class="icofont-simple-smile" style="color: #20b38e;"></i>
										<span data-toggle="counter-up"><?php echo $card_row['days'];?></span>
										<p>Totol Working Days</p>



									</div>
								</div>

								<div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="200">
									<div class="count-box">
										<i class="icofont-document-folder" style="color: #c042ff;"></i>
										<span data-toggle="counter-up"><?php echo $card_row['sums'];?></span>
										<p>Total Hours</p>
									</div>
								</div>

								<div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
									<div class="count-box">
										<i class="icofont-live-support" style="color: #46d1ff;"></i>
										<span data-toggle="counter-up"><?php echo $card_row['sums']*$row_id['per_money'];?></span>
										<p>Total money(<?php echo $row_id['per_money'];?> Pln/M)</p>
									</div>
								</div>


							</div>

						</div>
					</section><!-- End Counts Section -->
					<section id="team" class="team">
						<div class="container">

							<div class="section-title">
								<h2>Worked starts from <?php if(!empty($cr_month['date_at'])) {echo $cr_month['date_at'];} ?></h2>
								<p>here, how much you did </p>
							</div>

							<div class="row">

								<div class="col-xl-4 col-lg-6 col-md-6 " data-aos="fade-up">

									<table class="table table-hover table-responsive table-bordered table-success">

										<thead>

											<tr>
												<th class="text-center">S.N.</th>

												<th>Worked Date</th>
												<th>Hours</th>

											</tr>
										</thead>
										<tbody>
											<?php
											$i=0;
											$j= 1;
											while($row = mysqli_fetch_array($list)) {
												?>
												<tr>
													<td class="text-center"><?php  echo $j++; ?></td>
													<td>	<?php echo date("d F, Y (l) ",strtotime($row['date_at'])); ?></td>
													<td><?php echo $row["hours"]; ?><span style="font-size: 11px;"><?php if($row['remark']!=NULL){echo "<span class='text-danger '>hrs</span>";} else echo"hrs" ?> </span></td>

												</tr>
												<?php
												$i++;
											}
											?>

										</tbody>
									</table>


									<div class="row">
										<div class="col-12">
											<div class="text-left ml-2">
												<div class="text-danger font-italic">

													<?php
													$i=0;
													$j= 1;
													while($row = mysqli_fetch_array($list_remark)) {
														if($row["remark"]!=Null){

															?>
															<b class=" font-weight-bold">*</b> 
															<?php echo date("d F, Y (l",strtotime($row['date_at'])); ?>
															<?php echo $row["hours"]; ?><span style="font-size: 11px;">hrs</span>)
															<?php echo $row["remark"]; ?></br>


															<?php
															$i++;
														}}
														?> 
													</div>
												</div>
											</div>
										</div>

									</div>

								</div>
							</section><!-- End Our Team Section -->
							<!-- sending mail -->

							<?php include('footer.php'); ?>
						}


