<?php

include('assets/lib/header.php');
?>
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
	$T_UserName=$row['id'];
}

?>
<?php
include('link.php');
$result = mysqli_query($con,"SELECT * FROM users where email = '" . $T_UserName. "'");
$row= mysqli_fetch_array($result);


// get the last id which is last date one open and close date (mess expenses_table)
$get_last_date_id = mysqli_query($con,"SELECT * FROM mess_push where opn_cls_date IS NOT NULL  order by id desc");
$last_date_list_id = mysqli_fetch_array($get_last_date_id);
$last_date_id = $last_date_list_id['id'];
// mess start day
$mess_start_day = $last_date_list_id['post_date'];

// all expense list before last date
$user_expenses = mysqli_query($con,"SELECT * FROM mess_push where id<=$last_date_id And spent_money IS NULL  order by id desc LIMIT 1");


?>




<span class="msg"style="position: absolute; z-index: 11; color:green; width:auto; background-color: white; line-height: 30px; text-align: center; border:1px solid yellow; border-radius:4px; margin-top:2px;">
	<?php 
	if(!empty($_GET['message'])) {
		echo $_GET['message'];}
		?>

		<?php 
		if(isset($_GET['message_update']))
			{ echo $_GET['message_update'];}
		?>


	</span>
	<?php
	if($row['role']==1) {
		?>
		<div class="container">
			<div class="row ">
				<div class="col-lg-10 col-md-10  text-center ">
					<form action="mess_push.php" method="Post" enctype="multipart/form-data">

						<label class=" font-weight-bold text-white form-control bg-success">
							<span class="float-left">Mess Ledger  </span>
							<span class="text-warning pl-1 h6"><?php echo $mess_start_day; ?> </span>
							<span class="bg-primary float-right">
								<a href="mess_ledger.php" class="text-white p-1">
									Details 
								</a>
							</span>
						</label>


						<input type="hidden" name="user_id" class="txtField" value="<?php echo $row['id']; ?>"> 

						<!-- {{-- date --}} -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-ui-calendar"></i></span>
								</div>
								<input type="text" id="datepicker" class="keyboard form-control"  name="post_date" placeholder="date....." aria-describedby="inputGroupPrepend2" required autocomplete="off">

							</div>
						</div>
						<!-- {{-- Expenses --}} -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-dollar text-danger"></i></span>
								</div>
								<input class="form-control" id="validationDefaultUsername" name="spent_money" placeholder="Expenses ... " aria-describedby="inputGroupPrepend2" required>


							</div>
						</div>
						<!-- {{-- Remarks --}} --> 
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text " id="inputGroupPrepend2"><i class="icofont-ui-copy text-danger"></i></span>
								</div>
								<input class="form-control" id="remark" name="remark" placeholder="What we Do or Purchase Today ... " aria-describedby="inputGroupPrepend2" >


							</div>
						</div>
						<div class="form-group">

							<button type="submit" id ="success"class="btn btn-success" name="save"> Save</button>
						</div>
					</form>
				</div>   
			</div>
			<div class="row">
				<div class="col-lg-10 col-md-10 ">
					<!-- mess correction -->
					<p>

						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#mess" aria-expanded="false" aria-controls="collapseExample">
							Mess Begin / close
						</button>
					</p>

					<div class="collapse col-lg-10 col-md-10 col-sm-12" id="mess">
						<div class="card card-body">							
							<div class="row">
								<div class="col-6">
									<form id="form_1" action="" method="post">
										<a onclick="return confirm('Are You Sure Start Mess !');">
											<input  type="submit" class="btn btn-success" name="submit_1" value="Start New Mess" />
										</a>
									</form>
								</div>
								<div class="col-6">
									<button class="btn btn-primary " type="button" data-toggle="collapse" data-target="#edit" aria-expanded="false" aria-controls="collapseExample">
										Correction
									</button>
								</div>
							</div>

							
							<div class="collapse col-lg-12 col-md-12 col-sm-12" id="edit">
								<div class="card card-body">
									<table class="table table-hover table-primary ">
										<tr>
											
											<th>Post date</th>
											<th>Action</th>
										</tr>
										<?php
										$i=0;
										$j= 1;
										while($row = mysqli_fetch_array($user_expenses)) {
											?>
											<tr>
												
												<td class="badge badge-primary"><?php  echo $row['post_date']; ?></td>
												
												<td> 													<a class="mess-trash-btn" href="mess_session_delete.php?id=<?php echo $row["id"]; ?>"onclick="return confirm('Are You Sure Delete Mess !');">
													<i class="icofont-trash"></i>
												</a>

											</td>
										</tr>
										<?php
										$i++;
									}
									?>

									
								</table>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<?php
			// insert mess start date into database
	if (isset($_POST['submit_1'])) {
		mysqli_query($con,"INSERT INTO mess_push set post_date=Now(),opn_cls_date=Now(),user_id=$user_id;");
		mysqli_query($con,"INSERT INTO mess_user_paid set opn_cls_date=Now(),user_id=$user_id;");

		$message = "Record Modified Successfully";

		echo " <script> window.location.href='mess_post.php?message=$message';</script>";
		exit;

	}
	// 	elseif (isset($_POST['delete'])) {

 // $delete_id =$_POSTs['id'];;
	// 		// mysqli_query($con,"DELETE FROM mess_push WHERE id='" . $_GET['mess_id'] . "'");

	// 		$message = "Your message has been deleted ".$delete_id."nom";
	// 		echo " <script> window.location.href='mess_post.php?message=$message';</script>";
	// 		exit;
	// 	}

// Delete mess start date into database


	include('footer.php');}
?>