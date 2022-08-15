 <?php 
 include('assets/lib/header.php');
include ('link.php');?>
<div class="container mt-1">
      <div class="row  justify-content-center">
        <div class="col-lg-8 col-md-12 col-sm-12"style="overflow-x:scroll;">

          <form method="POST">
            <div class="input-group mb-3">

             
            
              
    
            <div class="input-group-prepend">
              <span class="input-group-text">Title</span>
            </div>
            <input type="text"class="form-control text-capitalize" name="cat_title" aria-label="Amount (to the nearest dollar)">

          </div>
          <!-- text -->
          <div class="input-group mb-3 ">
            <div class="input-group-prepend">
              <span class="input-group-text"> Details </span>
            </div>
            <textarea style="height: 250px;" id="editor" class="form-control" aria-label="With textarea" name="cat_text" placeholder="Write something ...."></textarea>
          </div>
          <!-- date -->
          <div class="input-group mb-5">
            <div class="input-group-prepend">
              <span class="input-group-text">Date</span>
            </div>
            <input type="text" id="datepicker" class="keyboard form-control"  name="cat_date" placeholder="date....." aria-describedby="inputGroupPrepend2" required autocomplete="off">
          </div>
          <!-- todo check box -->


          <label class="form-switch">
            Publish
            <input type="checkbox"  name="cat_status" value="1">
            <i></i>
          </label>
         



          <!-- submit button -->
          <div class="form-group">

            <button type="submit" id ="success" class="btn btn-success" name="submit_1"> Save</button>
          </div>
        </form>
      </div>
    </div>
    <?php 
if (isset($_POST['submit_1'])) {
  mysqli_query($con,"INSERT INTO rpt_cat set cat_date='" . $_POST['cat_date'] . "',cat= '" . $_POST['cat_title'] . "',cat_text = '" . $_POST['cat_text'] . "',cat_status = '" . $_POST['cat_status'] . "'");
    // mysqli_query($con,"INSERT INTO mess_user_paid set opn_cls_date=Now(),user_id=$user_id;");

  $message = "Record Modified Successfully";

  echo " <script> window.location.href='cat_post.php?message=$message';</script>";
  exit;

}

?>
<?php include'footer.php';?>