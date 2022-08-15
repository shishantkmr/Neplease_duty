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
			<label class=" font-weight-bold text-white form-control bg-success text-capitalize">
				<i class="border border-white rounded pl-2 pr-2">Ostrow</i>&nbsp; LIDER TAXI 
				<span class="float-right">
					<a class="call" href="tel:627358200">
						<i class="icofont-telephone h5"></i> +48 62 735 82 00</a>
				</span>
			</label>

			<ul class="list-group list-group-flush">
				<!-- user image -->
				<li class="list-group-item user_image">
					<img src="/assets/img/dir/lider_taxi.jpg" style="width:300px; height: 200px;">
					<i class="user_name"><i class="text-danger vertical_text">|</i>You can call easily, doesn't matter, where you are in Ostrow 20km territory.</i>
				</li>
			</ul>
		</div>
	</div>
</div>
<style>
	
</style>

<?php
include('footer.php');
?>