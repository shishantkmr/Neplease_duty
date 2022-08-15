<?php
include('header.php');

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
$all_user_result = mysqli_query($con,"SELECT * FROM users ");
$all_user_permit = mysqli_query($con,"SELECT * FROM users ");
$all_user_result_remove = mysqli_query($con,"SELECT * FROM users ");


?>




<div class="container">
	<div class="row ">
		<div class="col-lg-10 col-md-10  text-center ">
			<form action="user_money_paid_insert.php" method="Post" enctype="multipart/form-data" >
				
				<label class=" font-weight-bold text-white form-control bg-success">Add Friends Money &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>


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
				<!-- {{-- date --}} -->
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-ui-calendar"></i></span>
						</div>
						<input type="text" id="datepicker"  onkeyup="success()" class="get_date keyboard form-control"  name="date" placeholder="date....." aria-describedby="inputGroupPrepend2"  autocomplete="off">
						
					</div>
				</div>

				<!-- {{-- given money --}} -->
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-dollar"></i></span>
						</div>
						<input class="form-control" id="money" name="money" placeholder="This month mess reserve money ... " aria-describedby="inputGroupPrepend2" required>

						
					</div>
				</div>
				<!-- {{-- Remarks --}} -->
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text " id="inputGroupPrepend2"><i class="icofont-ui-copy text-danger"></i></span>
						</div>
						<input class="form-control" id="remark" name="remark" placeholder="Remarks Today ... " aria-describedby="inputGroupPrepend2" >
						
						
					</div>
				</div>

				<!-- {{-- img --}} -->
				<!-- <div class="form-group">
					<input type="file" accept="image/*" onchange="loadFile(event)" name="img" class="form-control img inputbox_color" placeholder="visa img...">
					<img id="output"/>
				</div> -->






				<div class="form-group">

					<button type="submit"  id ="button" disabled class="btn btn-success"> Send Post</button>
				</div>
			</form>
		</div>   
	</div>
</div>
<script>
	
        $( "#datepicker" ).on("keyup change", function () {
        	
       	document.getElementById('button').disabled = false; 

        });



    </script>
    <?php
    include('footer.php');
?>