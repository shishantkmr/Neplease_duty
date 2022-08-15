<head>
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
</style>
</head>


<?php
include('link.php');
$q = intval($_GET['q']);

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM occur_day WHERE  cat_id = '".$q."' AND daily = 0";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
   echo " 
      <li>
        <span class='occur_date'>".$row['occur_date']."</span> <span class='lead '>"; 
        $date1 = strtotime($row['occur_date']);
  $date2 = strtotime(date('y-m-d'));
 
  // Formulate the Difference between two dates
  $diff = abs($date2 - $date1);
 
  // To get the year divide the resultant date into
  // total seconds in a year (365*60*60*24)
  $years = floor($diff / (365*60*60*24));
 
  // To get the month, subtract it with years and
  // divide the resultant date into
  // total seconds in a month (30*60*60*24)
  $months = floor(($diff - $years * 365*60*60*24)
                                 / (30*60*60*24));
 
  // To get the day, subtract it with years and
  // months and divide the resultant date into
  // total seconds in a days (60*60*24)
  $days = floor(($diff - $years * 365*60*60*24 -
               $months*30*60*60*24)/ (60*60*24));
 
  // To get the hour, subtract it with years,
  // months & seconds and divide the resultant
  // date into total seconds in a hours (60*60)

 
  // To get the minutes, subtract it with years,
  // months, seconds and hours and divide the
  // resultant date into total seconds i.e. 60
 
 
  // To get the minutes, subtract it with years,
  // months, seconds, hours and minutes

 
  // Print the result
  
  if($years==0 && $months==0){ printf("%d days ", $days);}
  elseif($years==0){ printf("%d months %d days ",$months, $days);}
  else(printf("%d years, %d months, %d days", $years, $months,
               $days) );
    echo "</span>
        <div class='content'>
          <h3>".$row['occur_title']."</h3>
     
            ".$row['occur_text']."
        
        </div>
      </li>

  ";
  
}
echo "</table>";
mysqli_close($con);
?>
