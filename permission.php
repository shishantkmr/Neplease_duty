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

$all_user_result = mysqli_query($con,"SELECT * FROM users ");
$all_user_permit = mysqli_query($con,"SELECT * FROM users ");
$all_user_result_remove = mysqli_query($con,"SELECT * FROM users ");


?>

<div class="container">
	<div class="row ">
		<div class="col-lg-10 col-md-10  text-center ">
			<button type="button" class="btn btn-primary approve_show">Approve</button>
			<button type="button" class="btn btn-danger approve_remove">Remove</button>

			<form action="approved.php"  method="Post" id="approve" enctype="multipart/form-data">

				<label class=" font-weight-bold text-white form-control bg-success">Approve user &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="bg-primary"><a href="duty_list.php">&nbsp;&nbsp;&nbsp; List &nbsp;&nbsp;&nbsp; </a></span></label>


				<input type="hidden" name="user_id" class="txtField" value="<?php echo $row['id']; ?>"> 
				
				<!-- {{-- date --}} -->
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-ui-user"></i></span>
						</div>
						<select class="form-control text-capitalize" name="user">
							<?php
							$i=0;
							$j= 1;
							while($row = mysqli_fetch_array($all_user_result)) {
								?>
								<option class="text-capitalize" value="<?php echo $row["id"];?>"><?php echo $row["username"];?></option>

								<?php
								$i++;
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" id ="success"class="btn btn-success" >Approve</button>

				</div>
			</form>

			<!-- remove user -->
			<form action="approved_delete.php" id="remove"  method="Post" enctype="multipart/form-data">
				
				<label class=" font-weight-bold text-white form-control bg-danger">Remove user &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="bg-primary"><a href="duty_list.php">&nbsp;&nbsp;&nbsp; List &nbsp;&nbsp;&nbsp; </a></span></label>


				<input type="hidden" name="user_id" class="txtField" value="<?php echo $row['id']; ?>"> 
				
				<!-- {{-- date --}} -->
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-ui-user"></i></span>
						</div>
						<select class="form-control text-capitalize" name="user">
							<?php
							$i=0;
							$j= 1;
							while($row = mysqli_fetch_array($all_user_result_remove)) {
								?>
								<option class="text-capitalize" value="<?php echo $row["id"];?>"><?php echo $row["username"];?></option> 

								<?php
								$i++;
							}
							?>
						</select>
					</div>
				</div>

				




				<div class="form-group">

					<button type="submit" id ="success"class="btn btn-success" >Remove</button>

				</div>
			</form>

		</div>   
	</div>	

	<div class="row">
		<table class=" table-bordered table-hover  col-lg-12 mt-2">
			<thead>
				<tr class="line_height table-success">
					<th class="pl-1 hig">Name</th>
					<th class="pl-1 hig">Role</th>
				</tr>
			</thead>

			<?php
			$i=0;
			$j= 1;
			while($row = mysqli_fetch_array($all_user_permit)) {
				?>
				<?php if($row['role']==1){?><tr class="table-primary">
					<td class="text-capitalize pl-1" ><?php echo $row["username"];?></td>
					<td class="text-capitalize pl-1" ><?php echo 'Mess Commander';}?></td>
				</tr>
				<?php
				$i++;
			}
			?>

		</table>
	</div>
</div>
<style>
#approve{display: none;}
#remove{display: none;}
.line_height{line-height: 35px;}
</style>
<script>
	$(document).ready(function(){
		$(".approve_show").click(function(){        
        $("#approve").css("display", "inline"); // show the form
        $("#remove").css("display", "none");
    });
		$(".approve_remove").click(function(){        
        $("#approve").css("display", "none"); // show the form
        $("#remove").css("display", "inline");
    });

	});
</script>
<?php
include('footer.php');
?>