<?php  include('assets/lib/header.php');
include ('link.php');
// get all occur data




// get category list
$cat_list = mysqli_query($con, "SELECT * from rpt_cat order by id desc");

?>

<div class="container">
  <div class="row justify-content-center mt-5">
    <ul class="nav nav-pills  text-center" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ADD</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">List</a>
      </li>

    </ul>
  </div>
</div>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="container mt-1">
      <div class="row  justify-content-center">
        <div class="col-lg-8 col-md-12 col-sm-12"style="overflow-x:scroll;">

          <form method="POST">
            <div class="input-group mb-3">


              <div class="input-group-prepend">
                <span class="input-group-text"><a href="cat_post.php">Cat <i class="icofont-plus"></i></a></span>
              </div>
              <select name="cat" id="inputState" class="form-control">
                <option selected>Choose...</option>
                <?php while($row=mysqli_fetch_array($cat_list))
                {?>
                 <option value="<?php echo $row['id']?>"><?php echo $row['cat'];?>...</option>
               <?php }  mysqli_data_seek( $cat_list, 0 );   ?>                
             </select>

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
          <!-- todo check box -->


          <label class="form-switch">
            Published on Todo
            <input type="checkbox"  name="todo" value="1">
            <i></i>
          </label>
          <!-- Daily event check box -->
          <label class="form-switch">
            Published on Daily
            <input type="checkbox"  name="daily" value="1">
            <i></i>
          </label>



          <!-- submit button -->
          <div class="form-group">

            <button type="submit" id ="success" class="btn btn-success" name="submit_1"> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

  <div class="container mt-1">
    <div class="row  justify-content-center">
      <div class="col-lg-10 col-md-12 col-sm-12" style="overflow-x:scroll;  ">
        <!-- list should be here -->
        <div class="accordion" id="accordionExample">

          <?php

          while($cat = mysqli_fetch_array($cat_list))
          {

            $cat_id = $cat['id'];

            ?>
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo$cat['id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                   <?php echo $cat['cat'];?>
                 </button>
               </h2>
             </div>
             <div id="collapse<?php echo$cat['id'];?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
               <?php  daily_rpt_list($cat_id); ?>

             </div>
           </div>
         </div>
       <?php }?>
       <!-- other out of cat list -->


       <?php function daily_rpt_list($cat_id)
// get data from another table with cat id
       {
        global $con;
        $daily_rpt = mysqli_query($con, "SELECT * from occur_day where cat_id=$cat_id order by occur_date desc");
        while($daily=mysqli_fetch_array($daily_rpt))
        {
          echo "<p class='bg-faded'> <li> ".$daily['occur_title'];

          ?> 
          <!-- delete -->
          <a class="text-white" href="occur_edit.php?id=<?php echo $daily['occur_title']; ?>"> <span class="btn-sm btn-danger float-right mr-1"><i class="icofont-trash"></i></span> </a> 
          <!-- view -->
          <a class="text-white" href="occur_edit.php?id=<?php echo $daily['occur_title']; ?>"> <span class="btn-sm btn-primary float-right mr-1"><i class="icofont-eye"></i></span> </a> 
          <!-- edit -->
          <a class="text-white" href="occur_edit.php?id=<?php echo $daily['occur_title']; ?>"> <span class="btn-sm btn-success float-right mr-1"><i class="icofont-edit"></i></span> </a> 
        </p>

        <?php
      }
    }

    ?> 
    <div class="accordion" id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapseOne">
              Out of selected list
            </button>
          </h2>
        </div>
        <div id="collapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
            <?php 
            $data = mysqli_query($con,"select * from occur_day where cat_id  IS NULL order by occur_date");
            while($row = mysqli_fetch_array($data))
            {
              echo "<p class='bg-faded g-3'> <li> <span style='margin-right:-700px;'>".$row['occur_title']."</span><form style='margin-top:-18px;' method='POST'>
            <input type='hidden'  name='del' value=".$row['ids']."> <button style=' border:none; margin:0px;padding:0px;float:right;'type='submit' id ='success'  name='delete'> <span class='btn-sm btn-danger float-right '><i class='icofont-trash b-3'></i></span></button>
              <a class='text-white' href='occur_edit.php?id=".$row['occur_title']."'> <span class='btn-sm btn-primary float-right mr-1'><i class='icofont-eye'></i></span></a> <a class='text-white' href='occur_edit.php?id=".$row['occur_title']."'> <span class='btn-sm btn-success float-right mr-1'><i class='icofont-edit'></i></span> </a> 
              </form> </li> </p>";
            }
            ?>

          </div>
        </div>
      </div>
    </div>



  </div>

</div>
</div>
</div>
</div>

</div>


<?php 
if (isset($_POST['submit_1'])) {
  mysqli_query($con,"INSERT INTO occur_day set cat_id='" . $_POST['cat'] . "',occur_date='" . $_POST['occur_date'] . "',occur_title= '" . $_POST['occur_title'] . "',occur_text = '" . $_POST['occur_text'] . "',daily = '" . $_POST['daily'] . "',todo='" . $_POST['todo'] . "',occur_post_date = now()");
    // mysqli_query($con,"INSERT INTO mess_user_paid set opn_cls_date=Now(),user_id=$user_id;");

  $message = "Record Modified Successfully";

  echo " <script> window.location.href='anually_todo_post.php?message=$message';</script>";
  exit;

}
 if(isset($_POST['delete'])){
 mysqli_query($con,"Delete From occur_day WHERE ids='" . $_POST['del'] . "'");
 $message = "Record Deleted Successfully";

  echo " <script> window.location.href='anually_todo_post.php?message=$message';</script>";

 }
?>
<?php include'footer.php';?>