<?php  include('assets/lib/header.php');
include ('link.php');
// get all occur data
$get_occur = mysqli_query($con," SELECT * from occur_day order by occur_date Desc");

 ?>
<div class="container">
  <div class="row justify-content-center mt-5">
    <ul class="nav nav-pills  text-center" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">List</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ADD</a>
      </li>

    </ul>
  </div>
</div>
<div class="tab-content" id="pills-tabContent">
 
  <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

    <div class="container mt-1">
      <div class="row  justify-content-center">
        <div class="col-lg-10 col-md-12 col-sm-12" style="overflow-x:scroll;">
          <table class="table table-hover table-bordered ">
            <tbody>
              <tr>
                <td>S.N.</td>
                <td>Title</td>
                <td>Occur News</td>
                <td>Posted Date</td>
                <td>Past Date</td>
               
                <td>Action</td>
              </tr>
                <?php
                    $i=0;
                    $j= 1;
                    while($row = mysqli_fetch_array($get_occur)) {
                      if($row['todo']>0){
                      ?>
              <tr>
                <td><?php echo $j++.'.';?></td>
                <td><?php echo $row['occur_title'];?></td>
                <td><?php echo mb_strimwidth($row['occur_text'], 0,150,'..' );?></td>
                <td><?php echo $row['occur_date'];?></td>
               <td><?php
 
  // Declare and define two dates
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
?></td>
                
                <td class="action text-center col-2"> 
                <span class="badge badge-primary bg-primary ">
                  <a class="text-white" href="occur_edit.php?id=<?php echo $row['ids']; ?>"><i class="icofont-edit"></i></a>
                </span>
                <span class=" badge badge-danger  bg-danger ">
                  <a href="occur_delete.php?id=<?php echo $row["ids"]; ?>" onclick="return confirm('sure to delete !'); " ><i class="icofont-trash"></i></a>

                </span>
              </td>
              
              </tr>
              <?php
                    $i++;
                  }}
                  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
   <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="container mt-1">
      <div class="row  justify-content-center">
        <div class="col-lg-8 col-md-12 col-sm-12" style="overflow-x:scroll;">

          <form method="POST">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Title</span>
              </div>
              <input type="text"class="form-control text-capitalize" name="occur_title" aria-label="Amount (to the nearest dollar)">

            </div>
            <!-- text -->
            <div class="input-group mb-3 ">
              <div class="input-group-prepend">
                <span class="input-group-text"> Text </span>
              </div>
              <textarea style="height: 250px;" id="editor" class="form-control" aria-label="With textarea" name="occur_text" placeholder="Write something ...."></textarea>
            </div>
            <!-- date -->
            <div class="input-group mb-5">
              <div class="input-group-prepend">
                <span class="input-group-text">Date</span>
              </div>
              <input type="text" id="datepicker" class="keyboard form-control"  name="occur_date" placeholder="date....." aria-describedby="inputGroupPrepend2" required autocomplete="off">
            </div>
            <!-- submit button -->
            <div class="form-group">

              <button type="submit" id ="success" class="btn btn-success" name="submit_1"> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php 
if (isset($_POST['submit_1'])) {
  mysqli_query($con,"INSERT INTO occur_day set occur_date='" . $_POST['occur_date'] . "',occur_title= '" . $_POST['occur_title'] . "',occur_text = '" . $_POST['occur_text'] . "',occur_post_date = now()");
    // mysqli_query($con,"INSERT INTO mess_user_paid set opn_cls_date=Now(),user_id=$user_id;");

  $message = "Record Modified Successfully";

  echo " <script> window.location.href='anually_todo_post.php?message=$message';</script>";
  exit;

}

?>
<?php include'footer.php';?>