
<?php  include('assets/lib/header.php');
include ('link.php');

?>
<div class="container">

<div class="timeline"><h3>Daily event</h3>
    <ul>

  <?php



$state="SELECT DISTINCT occur_date FROM occur_day Where daily = 1 order by occur_date DESC";
$querys=mysqli_query($con,$state);
while($row=mysqli_fetch_array($querys))
{
    $state=$row['occur_date'];

   
?>
                    
                        <li>
        <span class="mb-2"> <?php echo $state; ?></span>
        <div class="content">
          
           <?php  city($state); ?>
    
                           
                               
                        
               
                    <?php }


function city($state){
global $con;
$city="SELECT DISTINCT occur_title from occur_day WHERE occur_date='$state' AND daily = 1";
    $query=mysqli_query($con,$city);
    while($row=mysqli_fetch_array($query))
    {
        $city=$row['occur_title'];
        ?>
                        <!-- <a href="city.php?city=<?php echo $city; ?>" style="text-decoration:none;"> -->
                            
                                <b class="badge badge-primary mr-1 ">@ </b><?php echo $city.'<br>' ?>
                            
                        <!-- </a> -->

                        <?php }
}?>


    </div>
      </li>
  
     
      
    </ul>
  </div></div>


