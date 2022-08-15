 <?php include('auth_session.php');include('assets/lib/user_details.php');?>



 <!DOCTYPE html>
 <html lang="en"> 

 <head>
 	<meta charset="utf-8">
 	<meta content="width=device-width, initial-scale=1.0" name="viewport">
 	<meta name="theme-color" content="#fcba03" >
 	<title>Duty Index</title>
 	<meta content="" name="descriptison">
 	<meta content="" name="keywords">

 	<!-- Favicons -->
 	<link href="assets/img/favicon.png" rel="icon">
 	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

 	<!-- Google Fonts -->
 	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

 	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
 	<script src="https://code.jquery.com/jquery-1.10.2.js" type="text/javascript" ></script>
 	<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js" type="text/javascript" ></script>
 	<!-- Vendor CSS Files -->
 	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 	<link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
 	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
 	<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
 	<link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
 	<link href="assets/vendor/aos/aos.css" rel="stylesheet">

 	<!-- Template Main CSS File -->
 	<link href="assets/css/style.css" rel="stylesheet">


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
 				<h1 class="text-light"><a href="index.php"><span>Neplese </span><i class="text-uppercase badge badge-primary" style="font-size:15px;"><?php echo $user_name; ?></i></a></h1>
 				<!-- Uncomment below if you prefer to use an image logo -->
 				<!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
 			</div>

 			<nav class="nav-menu float-right d-none d-lg-block">
 				<ul>
 					<li class="active"><a href="#header">Top</a></li>
 					<li class="active"><a href="index.php">Home</a></li>


 					<li class='drop-down'><a href=''>Profile</a>
 						<ul>
 							<li><a href='personal.php'>Personal Entry</a></li>
 							<li><a href="team.php">Team</a></li>

 						</ul>
 					</li>	<li class='drop-down'><a href=''>Duty</a>
 						<ul>

 							<li><a href="duty_post.php">Duty Post</a></li>
 							<li><a href="duty_list.php">Edit List</a></li>
 							<li><a href="monthly_rocords.php">Monthly Hour</a></li>

 						</ul>
 					</li>
<?php echo $user_cmp;?>


 					<?php    if($user_role==1){ echo "
 					<li class='drop-down'><a href=''>Mess Control</a>
 					<ul>
 					<li><a href='mess_post.php'>Expenses Entry</a></li>
 					<li><a href='user_check_paid.php'>Friends Paid</a></li>
 					<li><a href='mess_ledger.php'>This Month Details</a></li>
 					<li><a href='monthly_mess_records.php'>Monthly Record</a></li>
 					</ul>
 					</li>";
 					} elseif($user_cmp==$shis_cmp){echo "
 					<li class='drop-down'><a href=''>Mess Ledger</a>
 					<ul>
 					<li><a href='user_check_paid.php'>Friends Paid</a></li>
 					<li><a href='monthly_mess_records.php'>Monthly Record</a></li>
 					<li><a href='mess_ledger.php'>Details</a></li>
 					</ul>
 					</li>";}?>
 					<?php    if($user_email=='shishantkmrs@gmail.com'&&'Shishantkmrs@gmail.com'){ echo "

 					<li class='drop-down'><a href=''> <i class='icofont-ui-settings'></i> Setting </a>
 					<ul> 					
 					<li><a href=''>Post Annually Task</a></li>
 					<li><a href=''>List of Annually Task</a></li>
 					<li><a href='permission.php'>Change Role</a></li>
 					</ul>
 					</li>

 					";
 					} ?>
 					<li><a href="directory.php">Directory</a></li>
 					<li><a href="logout.php">logout</a></li>
 					<!-- <li><a href="#"> <?php echo $shis_email; ?></a></li> -->
 				</ul>
 			</nav><!-- .nav-menu -->

 		</div>
 	</header><!-- End Header -->

 	<!-- ======= Hero Section ======= -->
 	<section id="hero">
 		<div class="hero-container">
 			<div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

 				<span class="msg"style="position: absolute; z-index: 11; color:green; width:auto; background-color: white; line-height: 30px; text-align: center; border:1px solid yellow; border-radius:4px; margin-top:2px;">


 					<?php 
 					if (!empty($_SESSION['message'])) {
 						echo '<p class="message"> '.$_SESSION['message'].'</p>';
 						unset($_SESSION['message']);
 					}






 					if(isset($_GET['message']))
 						{ echo $_GET['message'];}
 					?>

 					<?php 
 					if(isset($_GET['message_update']))
 						{ echo $_GET['message_update'];}
 					?>


 				</span>




 				<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

 				<div class="carousel-inner" role="listbox">

 					<!-- Slide 1 -->
 					<div class="carousel-item active" style="background-image: url('assets/img/slide/slide-1.jpg');">
 						<div class="carousel-container">
 							<div class="carousel-content container">
 								<h2 class="animated fadeInDown">Welcome to <span class="text-uppercase"><?php echo $row_id['cmp_name']?></span></h2>
 								<p class="animated fadeInUp text-capitalize"><?php echo $row_id['cmp_name']?> company's  duty program for the all neplease guys.  </p>

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
