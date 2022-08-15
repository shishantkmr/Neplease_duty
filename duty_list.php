<?php
include('assets/lib/header.php');
if (isset($_SESSION['email'])){
	$T_UserName=$_SESSION['email'];
}
if (isset($_GET['id'])){
	$loginid=$_GET['id'];

//Get  login username if using GET
	$loginid=mysql_real_escape_string($loginid);
	$query = "SELECT `id` FROM `users` WHERE id=$loginid order by date_at asc";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	$T_UserName=$row['id'];

}
?>

<?php
include('link.php');
$result_id = mysqli_query($con,"SELECT * FROM users where email = '" . $T_UserName. "'");
$row_id= mysqli_fetch_array($result_id);
$user_id = $row_id['id'];
$result = mysqli_query($con,"SELECT * FROM duty where MONTH(date_at) = MONTH(now()) and YEAR(date_at) = YEAR(now())  And user_id = $user_id order by date_at asc");
?>
<div class="container mt-1">
	<div class="row">
		<div class="col-lg-12 col-md-10   text-center">
			<span class="card bg-success">
				
				<h4 class="text-center bg-success"> Monthly Duty list
					<a href="duty_post.php"><i class="icofont-plus text-white ml-2"></i></a>
					<!-- <a href="duty_list.php" class="badge badge-warning ml-2"> List</a> -->
				</h4>
			</span>
			<table class="table table-hover table-responsive table-bordered">

				<thead>

					<tr>
						<th>S.No.</th>
						<th>Date</th>
						<th id="remark">Hours/<span class="text-primary">Remark</span></th>
						<th class="hideshow">Remark</th>
						<th>Action</th>
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
							<td class="text-left"><?php echo date("d F, Y (l)",strtotime($row['date_at'])); ?></td>
							<td><?php echo $row["hours"]; ?><span style="font-size: 11px;">hrs</span></td>
							<td class="hideshow"><span style="font-size: 11px;"><?php echo $row["remark"]; ?></span></td>
							<td>
								<span class="badge badge-primary bg-primary">
									<a class="text-white" href="duty_edit.php?id=<?php echo $row["id"]; ?>"><i class="icofont-edit"></i></a>
									</span>
									<span class=" badge badge-danger  bg-danger">
										<a href="duty_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('sure to delete !'); " ><i class="icofont-trash"></i></a>
										
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
	<script>
		$(document).ready(function(){
			
		 $('.hideshow').hide();
$( "#remark" ).click(function() {     
    if($('.hideshow:visible').length)
        $('.hideshow').hide("slide", { direction: "right" }, 500);
    else
        $('.hideshow').show("slide", { direction: "right" }, 500);        
});

		});
	</script>	
	
	<?php include('footer.php')?>