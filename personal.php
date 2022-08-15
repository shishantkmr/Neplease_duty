<?php include('assets/lib/header.php'); 
include('link.php');?>


<?php

$result = mysqli_query($con,"SELECT * FROM users where email = '" . $T_UserName. "'");
$row= mysqli_fetch_array($result);


?>


<div class="container">
	<div class="row ">



		<?php
		
		// if (isset($_POST['upload'])) upload means submit name is upload

		if(count($_POST)>0) {
			// old image
			$old_image = $row['img'];


// image upload code
			$image = $_FILES['image']['name'];
// Get text
			$image_text = mysqli_real_escape_string($con, $image);

// image file directory
			$target = "assets/img/".basename($image);
			
			
			
			
			if(!$image==Null)
			{
				mysqli_query($con,"UPDATE users set username='" . $_POST['user_name'] . "',email='" . $_POST['email'] . "',cmp_name='" . $_POST['cmp_name'] . "',per_money='" . $_POST['per_money'] . "',img='$image',facebook='" . $_POST['facebook'] . "',instagram='" . $_POST['instagram'] . "' WHERE id='" . $_POST['user_id'] . "'");
			

				if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
				{
					$message = "Record Modified Successfully";
					unlink("assets/img/$old_image");

					echo " <script> window.location.href='personal.php';</script>";
					
				}
			}
			else{
				mysqli_query($con,"UPDATE users set username='" . $_POST['user_name'] . "',email='" . $_POST['email'] . "',cmp_name='" . $_POST['cmp_name'] . "',per_money='" . $_POST['per_money'] . "',img='$old_image',facebook='" . $_POST['facebook'] . "',instagram='" . $_POST['instagram'] . "' WHERE id='" . $_POST['user_id'] . "'");
			

				echo " <script> window.location.href='personal.php';</script>";
			}
		
				


			

			exit;
		}










// below code for get value

		?>

		<!-- user details on the list -->
		<div class="user_details col-lg-12 col-md-12 col-sm-12">
			<label class=" font-weight-bold text-white form-control bg-success text-capitalize"><i class="border border-white rounded pl-2 pr-2"><?php echo $user_name;?> </i> Your Details <a href="#" class="user_hide_show user_edit float-right badge badge-info bg-white text-primary "><i class=" icofont-edit"></i> Edit</a> </label>

			<ul class="list-group list-group-flush">
				<!-- user image -->
				<li class="list-group-item user_image">
					<img src="/assets/img/<?php if(isset($row['img'])){echo $row['img'];}else{echo"noimage.jpg";}?>" alt="<?php echo $row['img'];?>" style="width:150px; height: 200px;">
					<i class="user_name"><i class="text-danger vertical_text">|</i><?php echo $user_name;?></i>
				</li>
				<!-- company name -->

				<li class="list-group-item text-capitalize"><i class="icofont-ui-home text-primary h5 pr-2"></i> Company Name :
					<label for="staticEmail" class="col-sm-3  badge badge-primary col-form-label font-italic">
						<?php echo $row['cmp_name'];?>
					</label>
				</li>
				<!-- Join date -->

				<li class="list-group-item text-capitalize"><i class="icofont-calendar text-primary h5 pr-2"></i> Joined Date :
					<label for="staticEmail" class="col-sm-3  badge badge-primary col-form-label font-italic">
						<?php echo date("d F, Y (l) ",strtotime($row['create_datetime'])); ?>

					</label>
				</li>
				<!-- per hour cost -->

				<li class="list-group-item text-capitalize"><i class="badge badge-primary h5 pr-2"> PLN</i> Per Hour money :				<label for="staticEmail" class="col-sm-3  badge badge-primary  col-form-label font-italic">
					<?php echo $row['per_money'];?> Pln
				</label>
			</li>
			<!-- email -->

			<li class="list-group-item text-capitalize"><i class="icofont-at text-primary h5 pr-2"></i> Email Address :
				<label for="staticEmail" class="col-sm-3  badge badge-primary  col-form-label font-italic">
					<?php echo $row['email'];?>
					
				</li>
				<!-- facebook -->

				<li class="list-group-item text-capitalize"><i class="icofont-facebook text-white h5 pr-1 pl-1 border bg-primary border-primary rounded"></i> facebook Address :
					<label for="staticEmail" class="col-sm-3  badge badge-primary  col-form-label font-italic">
						<a target="_blank" href="https://www.facebook.com/<?php echo $row['facebook'];?>" class="text-white"><?php echo $row['facebook'];?></a>
					</label>
				</li>
				<!-- instagram -->

				<li class="list-group-item text-capitalize"><i class="icofont-instagram text-danger h5 pr-2"></i> Instagram Address :
					<label for="staticEmail" class="col-sm-3  badge badge-primary  col-form-label font-italic">
						<a target="_blank" href="https://instagram.com/<?php echo $row['instagram'];?>" class="text-white"><?php echo $row['instagram'];?></a>
					</label>
				</li>

				

			</ul>
		</div>




		<!-- user details (edit form) -->
		<div class="user_form col-lg-12 col-md-12  text-center ">
			<form action="" method="Post" enctype="multipart/form-data">
				<label class=" font-weight-bold text-white form-control bg-success text-capitalize"><i class="border border-white rounded pl-2 pr-2">Edit </i> Details 
				</label>
				<input type="hidden" name="user_id" class="txtField" value="<?php echo $row['id']; ?>"> 

				<!-- {{-- user name --}} -->
				<div class="form-group">
					<div class="input-group">
						<label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">User Name</label>
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-user text-primary"></i></span>
						</div>
						<input class="form-control" id="validationDefaultUsername" name="user_name" placeholder="User Name ... " aria-describedby="inputGroupPrepend2" value="<?php echo $user_name;?>" required>
					</div>
				</div>
				<!-- {{-- emaill --}} -->
				<div class="form-group">
					<div class="input-group">
						<label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">Email Address</label>
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-at text-primary"></i></span>
						</div>
						<input class="form-control" id="validationDefaultUsername" name="email" placeholder="Email ... " aria-describedby="inputGroupPrepend2" value="<?php echo $row['email'];?>" required>
					</div>
				</div>
				<!-- {{-- company --}} -->
				<div class="form-group">
					<div class="input-group">
						<label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">Company Name</label>
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-ui-home text-primary"></i></span>
						</div>
						<input class="form-control" id="validationDefaultUsername" name="cmp_name" placeholder="Company Name ... " aria-describedby="inputGroupPrepend2" value="<?php echo $row['cmp_name'];?>">
					</div>
				</div>

				<!-- {{-- per hour rate --}} -->
				<div class="form-group">
					<div class="input-group">
						<label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">Per Hour Rate</label>
						<div class="input-group-prepend">
							<span class="input-group-text text-primary font-weight-bold" id="inputGroupPrepend2">Pln</span>
						</div>
						<input class="form-control" id="remark" name="per_money" placeholder="Per hour money ... " aria-describedby="inputGroupPrepend2" value="<?php echo $row['per_money'];?>">
						
						
					</div>
				</div>

				<!-- {{-- img --}} -->
				<div class="form-group">
					<div class="input-group">
						<label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">User Image</label>
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-image text-primary"></i></span>
						</div>
						<input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="form-control img inputbox_color" placeholder="visa img...">
						<img id="output"/>
					</div>
				</div>

				
				<img src="/assets/img/<?php if(isset($row['img'])){echo $row['img'];}else{echo"noimage.jpg";}?>" alt="<?php echo $row['img'];?>" style="width:100px; height: 100px;">

				<!-- {{-- facebook --}} -->
				<div class="form-group">
					<div class="input-group">
						<label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">facebook</label>
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-facebook text-white  pr-1 pl-1 border bg-primary border-primary rounded"></i></span>
						</div>
						<input class="form-control" id="validationDefaultUsername" name="facebook" placeholder="facebook ... " aria-describedby="inputGroupPrepend2" value="<?php echo $row['facebook'];?>" >
					</div>
				</div>

				<!-- {{-- instagram --}} -->
				<div class="form-group">
					<div class="input-group">
						<label for="staticEmail" class="col-sm-3 col-form-label font-weight-bold">Instagram</label>
						<div class="input-group-prepend">
							<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-instagram text-danger"></i></span>
						</div>
						<input class="form-control" id="validationDefaultUsername" name="instagram" placeholder="Instagram ... " aria-describedby="inputGroupPrepend2" value="<?php echo $row['instagram'];?>">
					</div>
				</div>


				<div class="form-group">

					<button type="submit" name="upload" id ="success"class="btn btn-success"> Send Post</button>
				</div>
			</form>
		</div>   
	</div>
</div>
<style>
	.user_image img{width: 20%; height: 150px; border-radius: 4px; border: 2px solid lavender; box-shadow: 10px 7px 0px 1px lightgreen;}
	.user_name{padding-left: 20px; text-transform: capitalize; }
	.vertical_text{color: red; font-size: 35px;}
	.user_form{display:none ;}
</style>
<script>
	$(document).ready(function(){
		$(".user_hide_show").click(function(){        
        $(".user_form").css("display", "inline"); // show the form
        $(".user_details").css("display", "none");
    });
		$("#success").click(function(){        
        $(".user_hide_show").css("display", "none"); // show the form
        $(".user_details").css("display", "inline");
    });

	});
</script>
<?php
include('footer.php');
?>