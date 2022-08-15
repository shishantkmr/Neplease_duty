<?php
session_start();
if(!isset($_SESSION["email"])) {
  header("Location: login.php");
  exit();
}
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
$row_id= mysqli_fetch_array($result);
$user_id = $row_id['id'];
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://code.jquery.com/jquery-1.10.2.js" type="text/javascript" ></script>
  <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js" type="text/javascript" ></script>
  <!-- Vendor CSS Files -->
  <script src="https://code.jquery.com/jquery-1.10.2.js" type="text/javascript" ></script>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, td, th {
      border: 1px solid black;
      padding: 5px;
    }

    th {text-align: left;}
    .center{text-align: center;}
  </style>

</head>
<body>

  <?php
  $q = $_GET['q'];
  $sum = 0;
  include('link.php');
 
  if($q=="all"){
    $all_total = mysqli_query($con,"SELECT SUM(hours) as hour FROM duty  WHERE user_id = $user_id " ); // Only one current year value 
  $total_sum = mysqli_fetch_array($all_total);
  echo '<b>'.'Total Hours: '. $total_sum['hour'].'hrs</b>';
  }
  elseif(strlen($q)==4)
{
  $all_total = mysqli_query($con,"SELECT SUM(hours) as hour FROM duty  WHERE YEAR(date_at)=$q and user_id = $user_id " ); // Only one current year value 
  $total_sum = mysqli_fetch_array($all_total);
  echo '<b>'.date('Y').'s Total Hours: '. $total_sum['hour'].'hrs</b>';
}    
  else
  {
    $format = 'Y-m-d';
  $date = DateTime::createFromFormat($format, $q);

 
  $month = $date->format('m');
  $year = $date->format('Y');
     $result = mysqli_query($con,"SELECT * FROM duty  WHERE MONTH(date_at) = $month and YEAR(date_at)=$year and user_id = $user_id order by date_at asc" );
     $remark = mysqli_query($con,"SELECT * FROM duty  WHERE MONTH(date_at) = $month and YEAR(date_at)=$year and user_id = $user_id " );

  $sums = mysqli_query($con,"SELECT SUM(hours) as hour FROM duty  WHERE MONTH(date_at) = $month and YEAR(date_at)=$year and user_id = $user_id " );
  $month_total = mysqli_fetch_array($sums);
  echo '<b> Total Hours: ' . $month_total['hour']. 'hrs</b>';
  
    
  $i = 1;
 
  echo "<table table-responsive table-hover table-bordered table-success>
  <thead>
  <tr>

  <th class='center' >S.N.</th>
  <th class='center'>Date</th>
  <th class='center'>Hours</th>

  </tr></thead><tbody>";

  while($row = mysqli_fetch_array($result)) {
    echo "<tr>";

    echo "<td class='center'>" . $i++; "</td>";
    echo "<td>" . date("d F, Y (l) ",strtotime($row['date_at'])) . "</td>";
     echo "<td class='center'>" . $row['hours']; if($row['remark']!=NULL){echo "<span class='text-danger dot'>.</span>";}"</td>";
  
    echo "</tr>";
  }
  echo "</tbody></table>";

   while($row = mysqli_fetch_array($remark)) {
    if($row['remark']!=NULL){
    echo " </b> <div class='col-12'>
            <div class='text-left ml-1'>
              <div class='text-danger font-italic'><b class=' font-weight-bold text-danger'>* </b>";
  

    echo "".date("d F, Y (l ",strtotime($row['date_at'])) . "</td>";
    echo "<td class='center'>" . $row['hours'] . "<span style='font-size: 11px;'>hrs</span>) ".$row['remark'];
    echo "</div></div></div>";
  }}}
  
 
  mysqli_close($con);
  ?>
  <!-- remarks -->

  </body>
</html>


