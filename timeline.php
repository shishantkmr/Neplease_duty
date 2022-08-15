
<?php  include('assets/lib/header.php');
include ('link.php');
// get all occur data
$get_content = mysqli_query($con," SELECT * from rpt_cat order by id ASC");

?>


<div class="container">
<form>
  <select name="users" onchange="showUser(this.value)">
    <option value="">Select a person:</option>
  <?php 
while($row = mysqli_fetch_array($get_content)) {
  ?>

    <option value="<?php echo $row['id'];?>"><?php echo $row['cat'];?></option>
   <?php }?>
  </select>
</form>

  <div class="timeline">
  <ul>
    <span id="txtHint"><b>Your info will be listed here...</b></span>
 </ul>
</div>
</div>







<script>
  function showUser(str) {
    if (str == "") {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","ajax_fetch_timeline.php?q="+str,true);
      xmlhttp.send();
    }
  }
</script>