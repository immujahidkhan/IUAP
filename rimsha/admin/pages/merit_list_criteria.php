<?php
require_once "assets/header.php";
require_once "assets/sidebar.php";
$p_id=$pId;
$programD=$class->fetchdata("SELECT * FROM `admin_criteria_list` where p_id='$p_id' and user_id='$user_id'");
$Details=$programD->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['done']))
{
	
$t_seats= $_POST['t_seats'];
$merit= $_POST['merit'];
$punjab = $_POST['punjab'];
$sindh = $_POST['sindh'];
		
$query=$class->insert("INSERT INTO `admin_criteria_list`(`p_id`, `user_id`, `t_seats`, `quota`, `punjab`, `sindh`) VALUES ('$p_id','$user_id','$t_seats','$merit','$punjab','$sindh')");
			if($query){
			//$class->redirect("program_details.php?pId=1");
			?>
			 <script> window.location.href="fees.php?pId=<?php echo $p_id ;?>";</script>
			<?php
			}
			else{
				echo "Error";
				}

}
if(isset($_POST['update']))
{
	
$t_seats= $_POST['t_seats'];
$merit= $_POST['merit'];
$punjab = $_POST['punjab'];
$sindh = $_POST['sindh'];
		
$query=$class->insert("UPDATE `admin_criteria_list` SET `t_seats` = '$t_seats', `quota` = '$merit', `punjab` = '$punjab', `sindh` = '$sindh' where `p_id`='$p_id' AND `user_id`='$user_id'");
			if($query){
			//$class->redirect("program_details.php?pId=1");
			?>
			 <script> window.location.href="fees.php?pId=<?php echo $p_id ;?>";</script>
			<?php
			}
			else{
				echo "Error";
				}

}

?>
<script>
   function Test(myval) {
	   
	  var test = document.getElementById("test");
	  var x = document.getElementById("test");
	
	  
    if(myval=="No Quota System")
	{
	  document.getElementById("test").style.visibility = "hidden";
	}
	if(myval=="Quota System")
	{
	  document.getElementById("test").style.visibility = "visible";
	  
	if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "block";
    }	  
	}
}
</script>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Merit list criteria</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
               <div class="panel panel-primary">
				<div class="panel-heading">Enter Merit list criteria</div>
				<div class="panel-body">
<form  class="form-horizontal" action="#" method="post">  
   
  <div  class="form-group" id="Assc" class="ssc">
    <label class="control-label col-sm-5" for="email"><span class="star">*</span>Total No Of Seat :</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="t_seats" value="<?php echo $Details['t_seats']?>" required placeholder="">
    </div>
  </div>
  
  <div class="form-group">
     <?php
	 $checked = "";
	 $openMerit = "";
	 $visible = "hidden";
	 if($Details['quota']=="Quota System")
	 {	 
		$checked = "checked";
		$visible = "visible";
	 }else{
		$openMerit  = "checked";
	 }
	 ?>                      
  <div class="form-group"> 
  <div class="col-sm-offset-5 col-sm-5">
  <label class="radio-inline">
      <input type="radio"  value="No Quota System"  id="openMerit" <?php echo $openMerit;?> name="merit" required onclick="Test(this.value)">No Quota System
    </label>
    <label class="radio-inline">
      <input type="radio"  value="Quota System" id="enteryTest" <?php echo $checked;?> name="merit" required onclick="Test(this.value)">Quota System
    </label>
  </div>
  </div>
	<div id="test" <?php echo $visible?>>
   <div class="form-group">
    <label class="control-label col-sm-5" for="email">Punjab Seats :</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" value="<?php echo $Details['punjab'];?>" name="punjab"  placeholder="">
    </div>
  </div>
  
   <div class="form-group">
    <label class="control-label col-sm-5" for="email">Sindh Seats :</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" value="<?php echo $Details['sindh'];?>" name="sindh" placeholder="">
    </div>
  </div>
  </div>
   </div>
 
 <?php
	if($programD->rowCount()>0)
	{
	?>
 <div class="form-group"> 
  <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="col-sm-2 btn btn-primary" name="update" >Update</button>
  </div>
  </div>
  <?php
	}else{
		?>
<div class="form-group"> 
  <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="col-sm-2 btn btn-primary" name="done" >Save</button>
  </div>
  </div>
	<?php
	}
	?>
</form>

</div>
</div> 
</div>

</div>
</div>        
<?php

require_once "assets/footer.php";
?>