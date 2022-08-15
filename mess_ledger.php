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

// get the last id which is last date one open and close date (mess expenses_table)
$get_last_date_id = mysqli_query($con,"SELECT * FROM mess_push where opn_cls_date IS NOT NULL  order by id desc");
$last_date_list_id = mysqli_fetch_array($get_last_date_id);
$last_date_id = $last_date_list_id['id'];

// get the last id which is last date one open and close date(user_monthly paid table)
$get_last_user_paid_date_id = mysqli_query($con,"SELECT * FROM mess_user_paid where opn_cls_date IS NOT NULL order by id desc");
$last_date_user_paid_list_id = mysqli_fetch_array($get_last_user_paid_date_id);
$monthly_user_paid_id = $last_date_user_paid_list_id['id'];


// user given money this month on count
$user_given_money = mysqli_query($con,"SELECT count(post_date) as 'count_of_given', sum(given_money) as 'total_given' FROM mess_user_paid where id >$monthly_user_paid_id  ");
$user_given_row = mysqli_fetch_array($user_given_money);//fetch the data into single 

//mesh open date
$open = mysqli_query($con,"SELECT * From mess_push where opn_cls_date IS NOT NULL  order by opn_cls_date desc");
$open_date =mysqli_fetch_array($open);
 $id= $open_date['id'];







// all expense list before last date
$user_expenses = mysqli_query($con,"SELECT * FROM mess_push where id>$last_date_id order by post_date asc");



//total expenses on count
$result = mysqli_query($con,"SELECT count(post_date) as 'days', sum(spent_money) as 'sums' FROM mess_push where id >$last_date_id order by opn_cls_date desc");
$row = mysqli_fetch_array($result);


$result_row = mysqli_query($con,"SELECT *  FROM users where id = $user_id ");
$role_row= mysqli_fetch_array($result_row);


?>


<!-- ======= Counts Section ======= -->
<section class="counts section-bg">
	<div class="container">

		<div class="row">

			<div class="col-lg-3 col-md-6 text-center" data-aos="fade-up">
				<div class="count-box">
					<i class="icofont-bag-alt" style="color: #20b38e;"></i>
					<span data-toggle="counter-up"><?php echo $user_given_row['count_of_given'];?></span>
					<p>No. of Money Provided </p>



				</div>
			</div>
			<div class="col-lg-3 col-md-6 text-center" data-aos="fade-up">
				<div class="count-box">
					<i class="icofont-bank" style="color: #20b38e;"></i>
					<span data-toggle="counter-up"><?php echo $user_given_row['total_given'];?></span>
					<p> Money Provided </p>



				</div>
			</div>

			<div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="200">
				<div class="count-box">
					<i class="icofont-lunch" style="color: #c042ff;"></i>
					<span data-toggle="counter-up"><?php  echo  number_format($row['sums'],2);?></span>

					<p>Total Expenses</p>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 text-center" data-aos="fade-up" data-aos-delay="400">
				<div class="count-box">
					<i class="icofont-money" style="color: #46d1ff;"></i>
					<span data-toggle="counter-up"><?php echo number_format($user_given_row['total_given']-$row['sums'],2);?></span>
					<p>Total Remaining</p>
				</div>
			</div>


		</div>

	</div>
</section><!-- End Counts Section -->
<section id="team" class="team">
	<div class="container">
		<div class="section-title">
			<h2>Mess Shopping</h2>
			<p><u style=" text-decoration: underline;  text-decoration-color: orange; ">Here, How much we Spent</u> </p>
		</div>

		<div class="row">

			<div class="col-xl-6 col-lg-6 col-md-6 " data-aos="fade-up">
				
				<table class="table table-hover table-responsive table-bordered table-success">

					<thead>
						<?php if($role_row['role']==1){ echo " <button class='action_btn btn btn-primary float-left mt-2'>Edit Monthly Expenses</button>";}?>
						<tr>
							<th class="text-center">S.N.</th>
							<th> Expenses Date </th>
							<th> Description </th>
							<th> Spent Money </th>
							<?php if($role_row['role']==1){ echo "<th class='action'>Action</th>"; }?>

						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
						$j= 1;
						while($row = mysqli_fetch_array($user_expenses)) {
							?>
							<tr>
								<td class="text-center"><?php  echo $j++; ?></td>
								<td><?php echo date("d F, Y (l)",strtotime($row['post_date'])); ?></td>
								<td class="text-center"><?php  echo $row['remark']; ?></td>
								<td><?php echo $row["spent_money"]; ?><span style="font-size: 12px;"> Zlt</span> </td>
								<td class="action"> 
								<span class="badge badge-primary bg-primary">
									<a class="text-white" href="mess_this_month_edit.php?id=<?php echo $row["id"]; ?>"><i class="icofont-edit"></i></a>
								</span>
								<span class=" badge badge-danger  bg-danger">
									<a href="mess_this_month_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('sure to delete !'); " ><i class="icofont-trash"></i></a>

								</span>
							</td>
							</tr>
							<?php
							$i++;
						}
						?>

					</tbody>
				</table>


			<!-- 	<div class="row">
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

				</div> -->

			</div>
		</section><!-- End Our Team Section -->

		<?php include('footer.php'); ?>
<style>.action{display: none;}</style>
<script>
	
	$(document).ready(function(){
		$( ".action_btn" ).click(function() { 
			$('.action').css("display", "block");
		}); 
		$('.hideshow').hide();
	});
</script>
