
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
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js" type="text/javascript" ></script>
	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js" type="text/javascript" ></script>
  <!-- =======================================================
  * Template Name: Mamba - v2.0.1
  * Template URL: https://bootstrapmade.com/mamba-one-page-bootstrap-template-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
					<li><a href="duty_post.php">Duty Post</a></li>
					<li><a href="#portfolio">Portfolio</a></li>
					<li><a href="team.php">Team</a></li>
					<li><a href="duty_list.php">Edit List</a></li>
					<li><a href="logout.php">logout</a></li>
					<!-- <li class="drop-down"><a href="">Drop Down</a>
						<ul>
							<li><a href="#">Drop Down 1</a></li>
							<li><a href="#">Drop Down 3</a></li>
							<li><a href="#">Drop Down 4</a></li>
							<li><a href="#">Drop Down 5</a></li>
						</ul>mebleduty.rf.gd
					</li> -->
					
				</ul>
			</nav><!-- .nav-menu -->

		</div>
	</header><!-- End Header -->

	<!-- ======= Hero Section ======= -->
	<section id="hero">
		<div class="hero-container">
			<div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">


				
				

				
				<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

				<div class="carousel-inner" role="listbox">

					<!-- Slide 1 -->
					<div class="carousel-item active" style="background-image: url('assets/img/slide/slide-1.jpg');">
						<div class="carousel-container">
							<div class="carousel-content container">
								<h2 class="animated fadeInDown">Welcome to <span>Wajnert Meble</span></h2>
								<p class="animated fadeInUp">Wajnert company's  duty program for the all neplease guys.  </p>
								
							</div>
						</div>
					</div>

					<!-- Slide 2 -->
					<div class="carousel-item" style="background-image: url('assets/img/slide/slide-2.jpg');">
						<div class="carousel-container">
							<div class="carousel-content container">
								<h2 class="animated fadeInDown">We are feeling so pleasure here.</h2>
								<p class="animated fadeInUp">Since we came in poland we feel lucky to got chance know about the poland, not just in book.</p>
								
							</div>
						</div>
					</div>

					<!-- Slide 3 -->
					<div class="carousel-item" style="background-image: url('assets/img/slide/slide-3.jpg');">
						<div class="carousel-container">
							<div class="carousel-content container">
								<h2 class="animated fadeInDown">We are Great to find amazing guys.</h2>
								<p class="animated fadeInUp">Friends for co-operation each other inwhile bad moments.</p>
								
							</div>
						</div>
					</div>

				</div>

				<a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon icofont-rounded-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
					<span class="carousel-control-next-icon icofont-rounded-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>

			</div>
		</div>
	</section><!-- End Hero -->
	<main id="main">

		<?php
		include('link.php');
		$result = mysqli_query($con,"SELECT * FROM mess_user_paid WHERE id='" . $_GET['id'] . "'");
		$row= mysqli_fetch_array($result);
		if(count($_POST)>0) {

			mysqli_query($con,"UPDATE mess_user_paid set post_date='" . $_POST['date'] . "', remark='" . $_POST['remarks'] . "', given_money='" . $_POST['given_money'] . "' WHERE id='" . $_POST['userId'] . "'");

$message = "Record Modified Successfully";
	
			echo " <script> window.location.href='user_check_paid.php';</script>";
			exit;
		}
// below code for get value

		?>
		
		<div class="container">
			<div class="row ">
				<div class="col-lg-10 col-md-10  text-center ">
					<form action="" name="frmUser" method="POST" enctype="multipart/form-data">


						<label class=" font-weight-bold text-white form-control bg-success">Modify Post &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer;"><a href="duty_post.php" class="text-white " >&nbsp; <i class="icofont-plus"></i> &nbsp;&nbsp;&nbsp; </a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="bg-primary text-white"><a href="duty_list.php" class="text-white">&nbsp; List &nbsp;&nbsp; </a> </span></label>
						<input type="hidden" name="userId" class="txtField" value="<?php echo $row['id']; ?>">

						<!-- {{-- date --}} -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-ui-calendar"></i></span>
								</div>
								<input id="datepicker" class="keyboard form-control" id="validationDefaultUsername" name="date" placeholder="date....." aria-describedby="inputGroupPrepend2"  value="<?php echo $row['post_date']?>" autocomplete="off" required >
							</div>
						</div>
						<!-- {{-- given money --}} -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-dollar"></i></span>
								</div>
								<input class="form-control" id="validationDefaultUsername" name="given_money" placeholder="Given money ... " aria-describedby="inputGroupPrepend2" value="<?php echo $row['given_money']?>"required>
							</div>
						
						</div>
						<!-- {{-- remark --}} -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupPrepend2"><i class="icofont-ui-copy"></i></span>
								</div>
								<input class="form-control" id="remarks" name="remarks" placeholder="Remark ... " aria-describedby="remark" value="<?php echo $row['remark'] ?>">
							</div>
						</div>

						






				<div class="form-group">

					<button type="submit" id ="success"class="btn btn-success"> Send Post</button>
				</div>
			</form>
		</div>   
	</div>
</div>
<?php
include('footer.php')
?>