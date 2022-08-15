<?php include('assets/lib/header.php')?>
<?php

if (isset($_SESSION['email'])){
	$T_UserName=$_SESSION['email'];
}
if (isset($_GET['id'])){
	$loginid=$_GET['id'];

//Get  login username if using GET
	$loginid=mysql_real_escape_string($loginid);
	$query = "SELECT `id` FROM `users` WHERE id=$loginid order by date_at asc";
	$results = mysql_query($query);
	$row = mysql_fetch_row($results);
	$T_UserName=$row['id'];

}
?>

<?php
include('link.php');
$result_id = mysqli_query($con,"SELECT * FROM users where email = '" . $T_UserName. "'");
$row_id= mysqli_fetch_array($result_id);
$user_id = $row_id['id'];
//mesh user paid open date
$mesh_user = mysqli_query($con,"SELECT * From mess_user_paid where opn_cls_date IS NOT NULL  order by opn_cls_date desc");
$mesh_user_id =mysqli_fetch_array($mesh_user);
 $mesh_users_id= $mesh_user_id['id'];


// get the last id which is last date one open and close date(user_monthly paid table)
$get_last_user_paid_date_id = mysqli_query($con,"SELECT * FROM mess_user_paid where opn_cls_date IS NOT NULL order by id desc");
$last_date_user_paid_list_id = mysqli_fetch_array($get_last_user_paid_date_id);
$monthly_user_paid_id = $last_date_user_paid_list_id['id'];

$result = mysqli_query($con,"SELECT mup.*,usr.username,usr.role FROM mess_user_paid mup,users usr where usr.id=mup.user_id And mup.id>$monthly_user_paid_id order by post_date asc"); 


$result_row = mysqli_query($con,"SELECT *  FROM users where id = $user_id ");
$role_row= mysqli_fetch_array($result_row);
?>
<div class="container mt-1">
	<div class="row">
		<div class="col-lg-12 col-md-10   text-center">
			<span class="card bg-success">
				
				<h4 class="text-center bg-success">List of Paid Friends
					
					<!-- <a href="duty_list.php" class="badge badge-warning ml-2"> List</a> -->
				</h4>
			</span>
			<table class="table table-hover table-responsive table-bordered">

				<thead>
					<?php if($role_row['role']==1){ echo "<a href='user_money_paid.php'> <button class='mr-2 action_btn btn btn-primary float-left mt-2'>Add </button></a> <button class='action_btn btn btn-primary float-left mt-2'>Edit Paid friends</button>";}?>
					<tr>
						<th>S.No.</th>
						<th >Friends</th>
						<th>Date</th>
						<th id="remark">Given Money/<span class="text-primary">Remark</span></th>
						
						<th class="hideshow">Remark</th>
						<?php if($role_row['role']==1){ echo "<th class='action'>Action</th>"; }?>
						
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
					$j= 1;
					while($row = mysqli_fetch_array($result)) {
						?>
						<tr>
							<td><?php  echo $j++; ?></td>
							<td class="text-left text-capitalize"><?php echo $row['username']; ?></td>
							<td class="text-left"><?php echo date("d F, Y (l)",strtotime($row['post_date'])); ?></td>
							<td><?php echo $row["given_money"]; ?><span style="font-size: 11px;">zlt</span></td>
							<td class="hideshow"><span style="font-size: 11px;"><?php echo $row["remark"]; ?></span></td>
							<td class="action"> 
								<span class="badge badge-primary bg-primary">
									<a class="text-white" href="mess_user_paid_edit.php?id=<?php echo $row["id"]; ?>"><i class="icofont-edit"></i></a>
								</span>
								<span class=" badge badge-danger  bg-danger">
									<a href="mess_user_paid_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('sure to delete !'); " ><i class="icofont-trash"></i></a>

								</span>
							</td>
						</tr>
						<?php
						$i++;
					}
					?>
				</tbody>
			</table>
		</div>

	</div>
</div>
<style>.action{display: none;}</style>
<script>
	$(document).ready(function(){
		$( ".action_btn" ).click(function() { 
			$('.action').css("display", "inline");
		}); 
		$('.hideshow').hide();
		$( "#remark" ).click(function() {     
			if($('.hideshow:visible').length)
				$('.hideshow').hide("slide", { direction: "right" }, 500);
			else
				$('.hideshow').show("slide", { direction: "right" }, 500);        
		});

	});
</script>	

<?php include('footer.php'); ?>