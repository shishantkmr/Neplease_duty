<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Duty Index</title>
	<meta content="" name="descriptison">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="assets/vendor/aos/aos.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/timeline.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js" type="text/javascript" ></script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js" type="text/javascript" ></script>
  <!-- =======================================================
  * Template Name: Mamba - v2.0.1
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
</head>

<body>

	<!-- ======= Top Bar ======= -->
	<section id="topbar" class="d-none d-lg-block">
		<div class="container clearfix">
			<div class="contact-info float-left">
				<i class="icofont-envelope"></i><a href="mailto:shishantkmrs@gmail.com">shishantkmrs@gmail.com</a>
				<i class="icofont-phone"></i> +48 727825007
			</div>
			<div class="social-links float-right">
				<a href="#" class="twitter"><i class="icofont-twitter"></i></a>
				<a href="#" class="facebook"><i class="icofont-facebook"></i></a>
				<a href="#" class="instagram"><i class="icofont-instagram"></i></a>
				<a href="#" class="skype"><i class="icofont-skype"></i></a>
				<a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
			</div>
		</div>
	</section>

	<!-- ======= Header ======= -->
	<header id="header">
		<div class="container">

			<div class="logo float-left">
				<h1 class="text-light"><a href="index.php"><span>Neplese </span><i class="text-uppercase badge badge-primary" style="font-size:15px;"></i></a></h1>
				<!-- Uncomment below if you prefer to use an image logo -->
				<!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
			</div>

			<nav class="nav-menu float-right d-none d-lg-block">
				<ul>
					<li class="active"><a href="#header">Top</a></li>
					<li class="active"><a href="index.php">Home</a></li>
					<li><a href="">Back</a></li>
					
				</ul>
			</nav><!-- .nav-menu -->

		</div>
	</header><!-- End Header -->

	
	<main id="main">

		<?php
		include('link.php');
		$result = mysqli_query($con,"SELECT * FROM occur_day WHERE occur_title='" . $_GET['id'] . "'");
		$row= mysqli_fetch_array($result);
		if(count($_POST)>0) {

			mysqli_query($con,"UPDATE occur_day set occur_date='" . $_POST['occur_date'] . "' ,occur_title='" . $_POST['occur_title'] . "',daily='" . $_POST['daily'] . "',  occur_text='" . $_POST['occur_text'] . "',todo='" . $_POST['todo'] . "' WHERE ids='" . $_POST['userId'] . "'");

			$message = "Record Modified Successfully";

			echo " <script> window.location.href='anually_todo_post.php?message=$message';</script>";
			exit;
		}
// below code for get value

		?>
		
		<div class="container">
			<div class="row ">
				<div class="col-lg-10 col-md-10  text-center " style="overflow-x:scroll;">
					<form action="" name="frmUser" method="POST" enctype="multipart/form-data">


						<label class=" font-weight-bold text-white form-control bg-success">Modify Post &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer;"><a href="anually_todo_post.php" class="text-white " >&nbsp; <i class="icofont-plus"></i> &nbsp;&nbsp;&nbsp; </a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="bg-primary text-white"><a href="mess_ledger.php" class="text-white">&nbsp; List &nbsp;&nbsp; </a> </span></label>
						<input type="hidden" name="userId" class="txtField" value="<?php echo $row['ids']; ?>">

						<!-- {{-- date --}} -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-ui-calendar"></i></span>
								</div>
								<input id="datepicker" class="keyboard form-control" id="validationDefaultUsername" name="occur_date" placeholder="date....." aria-describedby="inputGroupPrepend2"  value="<?php echo $row['occur_date']?>" autocomplete="off" required >
							</div>
						</div>
						<!-- {{-- occur title --}} -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-copy"></i></span>
								</div>
								<input class="form-control" id="validationDefaultUsername" name="occur_title" placeholder="Given money ... " aria-describedby="inputGroupPrepend2" value="<?php echo $row['occur_title']?>"required>
							</div>

						</div>
						<!-- {{-- occur text --}} -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-edit"></i></span>
								</div>
								<textarea style="height: 250px; width:100%;" id="editors" class="col-lg-12 form-control" aria-label="With textarea" name="occur_text" placeholder="Write something ...."><?php echo $row['occur_text']?></textarea>
							</div>

						</div>
						
						<!-- todo check box -->
						<div class="input-group mb-3 text-left">
							
							<!-- daily report -->
							<label class="form-switch">
								Daily report
								<?php if($row['daily']>0){?>
									<input type="checkbox" checked  name="daily" value="1" >
									<i></i>
								<?php }else{?>
									<input type="checkbox"  name="daily" value="1">
									<i></i>
								<?php }?>
							</label>
							<!-- make todo -->
							<label class="form-switch">
								To do
								<?php if($row['todo']>0){?>
									<input type="checkbox" checked name="todo" value="1" >
									<i></i>
								<?php }else{?>
									<input type="checkbox"   name="todo" value="1" >
									<i></i>
								<?php }?>
							</label>

							
							

						</div>





						<div class="form-group">

							<button type="submit" id ="success"class="btn btn-success"> Send Post</button>
						</div>
					</form>
				</div>   
			</div>
		</div>
		<?php
		include'footer.php';
	?>