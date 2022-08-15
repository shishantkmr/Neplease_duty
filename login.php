<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/auth.css"/>
    <!-- great vibes fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    clearstatcache();
    require('link.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['email'])) {
        $email = stripslashes($_REQUEST['email']);    // removes backslashes
        $emails = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE email='$emails'
        AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['email'] = $emails;
            // Redirect to user dashboard page
            header("Location: index.php");
        } else {
            echo "<div class='form'>
            <h3>Incorrect Username/password.</h3><br/>
            <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
            </div>";
        }
    } else {
        ?>

        <div class="container" >
         <form class="forms" method="post" name="login">
            <div class="row" style="height: 100vh;">
                <div class="card-box text-center d-flex align-self-center justify-content-center">
                    <div class="card bg-card">
                        <div class="card-header">
                            <div class="row g-1">
                                <nav class="col-3  text-start login-img">
                                    <a href="index.php"><img src="./assets/img/logo.jpg" alt="mid coffee"></a>

                                </nav>

                                <aside class="col-6 " >Open the door </aside>
                            </div>

                        </div>
                        
                        <div class="card-body">

                            <div class="row  justify-content-center">

                                <div class=" col-sm-9 col-md-9 py-4">
                                    <input type="text" name="email" class="form-control" placeholder="User id">
                                </div>

                                <!-- password -->


                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" placeholder="********">
                                </div>


                            </div>
                            <div class=" text-white mt-3 pl-4">
                                <input type="submit" value="Login" name="submit" class="btn btn-success btn-md"/>
                            </div>

                        </div>
                        <div class="card-footer">
                            <p>
                                <a  class="" href="forgot.php">forgot your password? </a>
                                <a href="register.php"> Register</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>  
        </form>
    </div>
    <?php
}
?>
</body>
</html>