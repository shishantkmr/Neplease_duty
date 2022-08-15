<?php 
session_start();
$error = array();

require "mail.php";

	// if(!$con = mysqli_connect("sql111.epizy.com","epiz_28317872","Pv9wigHohd3","epiz_28317872_duty")){
if(!$con = mysqli_connect("localhost","root","","neplese_duty")){

	die("could not connect");
}

$mode = "enter_email";
if(isset($_GET['mode'])){
	$mode = $_GET['mode'];
}

	//something is posted
if(count($_POST) > 0){

	switch ($mode) {
		case 'enter_email':
				// code...
		$email = $_POST['email'];
				//validate email
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$error[] = "Please enter a valid email";
		}elseif(!valid_email($email)){
			$error[] = "That email was not found";
		}else{

			$_SESSION['forgot']['email'] = $email;
			send_email($email);
			header("Location: forgot.php?mode=enter_code");
			die;
		}
		break;

		case 'enter_code':
				// code...
		$code = $_POST['code'];
		$result = is_code_correct($code);

		if($result == "the code is correct"){

			$_SESSION['forgot']['code'] = $code;
			header("Location: forgot.php?mode=enter_password");
			die;
		}else{
			$error[] = $result;
		}
		break;

		case 'enter_password':
				// code...
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		if($password !== $password2){
			$error[] = "Passwords do not match";
		}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
			header("Location: forgot.php");
			die;
		}else{

			save_password($password);
			if(isset($_SESSION['forgot'])){
				unset($_SESSION['forgot']);
			}

			header("Location: login.php");
			die;
		}
		break;

		default:
				// code...
		break;
	}
}

function send_email($email){ 

	global $con;

	$expire = time() + (60 * 1);
	$code = rand(10000,99999);
	$email = addslashes($email);

	$query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
	mysqli_query($con,$query);

		//send email here
	send_mail($email,'Password reset',"Your code is " . $code);
}

function save_password($password){

	global $con;

	$password = md5($password);
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "update users set password = '$password' where email = '$email' limit 1";
	mysqli_query($con,$query);

}

function valid_email($email){
	global $con;

	$email = addslashes($email);

	$query = "select * from users where email = '$email' limit 1";		
	$result = mysqli_query($con,$query);
	if($result){
		if(mysqli_num_rows($result) > 0)
		{
			return true;
		}
	}

	return false;

}

function is_code_correct($code){
	global $con;

	$code = addslashes($code);
	$expire = time();
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
	$result = mysqli_query($con,$query);
	if($result){
		if(mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_assoc($result);
			if($row['expire'] > $expire){

				return "the code is correct";
			}else{
				return "the code is expired";
			}
		}else{
			return "the code is incorrect";
		}
	}

	return "the code is incorrect";
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.10.2.js" type="text/javascript" ></script>
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 	
	<title>Forgot</title>
</head>
<body style="background-image:url(https://images.ctfassets.net/23aumh6u8s0i/4JKsesGb6RuQLsjVnUmB0j/0bcbb36344547e9ab698b9077f80170a/16_brightness); background-size:cover; height: 1vh;">
	<style type="text/css">
	
	*{
		font-family: tahoma;
		font-size: 13px;
	}

	form{
		width: 100%;
		
		margin: auto;

		padding: 10px;
	}

	.textbox{
		padding: 5px;
		width: 500px;
	}
	.login{font-size: 1.3rem;font-family: calibari;color: white;}
	.margin_top{position: relative; top: 200px;}
</style>

<?php 

switch ($mode) {
	case 'enter_email':
					// code...
	?>

	<div class="row margin_top d-flex align-items-center justify-content-center ">

		<div class="card text-white bg-primary mb-3  text-center trans " style="max-width: 85rem;">
			<div class="card-header"><h1>Forgot Password</h1></div>
			<div class="card-body">

				<form method="post" action="forgot.php?mode=enter_email"> 

					<h3>Enter your email below</h3>
					<span style="font-size: 12px;color:red;">
						<?php 
						foreach ($error as $err) {
									// code...
							echo $err . "<br>";
						}
						?>
					</span>
					<input class="textbox" type="email" name="email" placeholder="Email"><br>
					<br style="clear: both;">
					<input class="btn btn-success" type="submit" value="Next">
					<br><br>
					<div ><a href="login.php" class="text-white login">Login</a></div>
				</form>


			</div>
		</div>
	</div>



	<?php				
	break;

	case 'enter_code':
					// code...
	?>
	<div class="row margin_top d-flex align-items-center justify-content-center ">

		<div class="card text-white bg-primary mb-3  text-center trans " style="max-width: 85rem;">
			<div class="card-header"><h1>Forgot Password</h1></div>
			<div class="card-body">
				<form method="post" action="forgot.php?mode=enter_code" > 
					
					<h3>Enter your the code sent to your email</h3>
					<span style="font-size: 12px;color:red;">
						<?php 
						foreach ($error as $err) {
									// code...
							echo $err . "<br>";
						}
						?>
					</span>

					<input class="textbox" type="text" name="code" placeholder="12345"><br>
					<br style="clear: both;">
					<input type="submit" value="Next" >
					<a href="forgot.php">
						<input type="button" value="Start Over">
					</a>
					<br><br>
					<div><a href="login.php" class="login">Login</a></div>
				</form>
			</div>
		</div>
	</div>
	<?php
	break;

	case 'enter_password':
					// code...
?><div class="row margin_top d-flex align-items-center justify-content-center ">
	
	<div class="card text-white bg-primary mb-3  text-center trans " style="max-width: 85rem;">
		<div class="card-header"><h1>Rest Your New Password</h1></div>
		<div class="card-body">
			<form method="post" action="forgot.php?mode=enter_password"> 

				<h3>Enter your new password</h3>
				<span style="font-size: 12px;color:red;">
					<?php 
					foreach ($error as $err) {
									// code...
						echo $err . "<br>";
					}
					?>
				</span>

				<input class="textbox mb-2" type="text" name="password" placeholder="New Password"><br>
				<input class="textbox " type="text" name="password2" placeholder="Retype Password"><br>
				<br style="clear: both;">
				<input type="submit" value="Change" >
				<a href="forgot.php">
					<input type="button" value="Start Over" class="ml-5">
				</a>
				<br><br>
				<div><a href="login.php" class="login">Login</a></div>
			</form>
		</div>
	</div>
</div>
<?php
break;

default:
					// code...
break;
}

?>


</body>
</html>